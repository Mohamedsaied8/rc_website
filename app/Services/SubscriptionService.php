<?php

namespace App\Services;

use App\Models\Program;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

/**
 * Aggregates the authenticated user's standing across all four Robotics Corner
 * products into one uniform shape for the profile page.
 *
 * Where each product's data actually lives:
 *   - Courses            local MySQL `enrollments` (program slugs)
 *   - RoboHub Premium    canonical Supabase `premium_plans`
 *   - ConnectedLabs      canonical Supabase `bookings` (pay-per-use, not a tier)
 *   - RoboAgent Pro/Max  canonical Supabase `roboagent_plans` — TABLE DOES NOT
 *                        EXIST YET. The query is wired anyway and degrades to
 *                        "no plan"; it starts returning real data the moment the
 *                        table is created, with no code change here.
 *
 * Every resolver returns the same envelope so the view can stay dumb:
 *   key, active (bool), plan (string|null), items (array), meta (array)
 */
class SubscriptionService
{
    public function __construct(protected SupabaseRest $rest)
    {
    }

    /** @return array<string, array> keyed by product */
    public function for(User $user): array
    {
        return [
            'courses'       => $this->courses($user),
            'robohub'       => $this->robohub($user),
            'roboagent'     => $this->roboagent($user),
            'connectedlabs' => $this->connectedlabs($user),
        ];
    }

    // ---------------------------------------------------------------- courses

    /**
     * Enrollments live locally. Note these attach to PROGRAMS (via the
     * `selected_program` slug), not to `courses` rows — there is no
     * user↔course relation in this schema.
     */
    protected function courses(User $user): array
    {
        $enrollments = $user->enrollments()->with('cohort')->latest()->get();

        $programNames = Program::whereIn('slug', $enrollments->pluck('selected_program')->filter()->unique())
            ->pluck('title', 'slug');

        return [
            'key'    => 'courses',
            'active' => $enrollments->isNotEmpty(),
            'plan'   => null,
            'items'  => $enrollments->all(),
            'meta'   => ['programNames' => $programNames],
        ];
    }

    // ---------------------------------------------------------------- robohub

    /**
     * `premium_plans` is UNIQUE(user_id) with `plan_type` defaulting to 'free'.
     * plan_type is free text (no enum/CHECK), so treat anything that isn't
     * 'free' as premium rather than matching an exact string.
     */
    protected function robohub(User $user): array
    {
        $row = $this->cached($user, 'robohub', fn () => $this->rest->selectForUser(
            'premium_plans',
            (string) $user->supabase_id,
            ['select' => 'plan_type,active_until,extra_bids,created_at', 'limit' => 1],
        )[0] ?? null);

        $planType = $row['plan_type'] ?? 'free';
        $until    = !empty($row['active_until']) ? Carbon::parse($row['active_until']) : null;
        $expired  = $until && $until->isPast();
        $active   = $planType !== 'free' && !$expired;

        return [
            'key'    => 'robohub',
            'active' => $active,
            'plan'   => $active ? ucfirst($planType) : null,
            'items'  => [],
            'meta'   => [
                'active_until' => $until,
                'expired'      => (bool) ($expired && $planType !== 'free'),
                'extra_bids'   => $row['extra_bids'] ?? 0,
            ],
        ];
    }

    // -------------------------------------------------------------- roboagent

    /**
     * No backing table yet — RoboAgent's pricing page is hardcoded copy and the
     * `?plan=` param it links with is consumed by nothing. This resolver is
     * deliberately wired to the table the plans WILL live in, so the profile
     * card lights up automatically once billing ships. Until then PostgREST
     * 404s and SupabaseRest returns [], i.e. "free".
     */
    protected function roboagent(User $user): array
    {
        $row = $this->cached($user, 'roboagent', fn () => $this->rest->selectForUser(
            'roboagent_plans',
            (string) $user->supabase_id,
            ['select' => 'plan_type,active_until', 'limit' => 1],
        )[0] ?? null);

        $planType = $row['plan_type'] ?? 'free';
        $until    = !empty($row['active_until']) ? Carbon::parse($row['active_until']) : null;
        $expired  = $until && $until->isPast();
        $active   = in_array($planType, ['pro', 'max'], true) && !$expired;

        return [
            'key'    => 'roboagent',
            'active' => $active,
            'plan'   => $active ? ucfirst($planType) : null,
            'items'  => [],
            'meta'   => ['active_until' => $until, 'expired' => (bool) $expired],
        ];
    }

    // ---------------------------------------------------------- connectedlabs

    /**
     * ConnectedLabs is pay-per-booking, not a membership: "subscribed" here
     * means "has upcoming or in-progress robot time". Cancelled bookings are
     * excluded; past ones count as history, not as active.
     */
    protected function connectedlabs(User $user): array
    {
        $rows = $this->cached($user, 'connectedlabs', fn () => $this->rest->selectForUser(
            'bookings',
            (string) $user->supabase_id,
            [
                'select' => 'id,start_time,end_time,hours,total_price,status,created_at,robot:robots(name,price_per_hour)',
                'order'  => 'start_time.desc',
                'limit'  => 5,
            ],
        )) ?: [];

        $upcoming = array_values(array_filter($rows, function ($b) {
            $live = in_array($b['status'] ?? '', ['paid', 'active'], true);

            return $live && !empty($b['end_time']) && Carbon::parse($b['end_time'])->isFuture();
        }));

        return [
            'key'    => 'connectedlabs',
            'active' => count($upcoming) > 0,
            'plan'   => null,
            'items'  => $rows,
            'meta'   => ['upcoming' => $upcoming],
        ];
    }

    // ----------------------------------------------------------------- shared

    /**
     * Short TTL so the profile page doesn't hit PostgREST three times on every
     * refresh, while still reflecting a fresh purchase within a minute.
     */
    protected function cached(User $user, string $key, \Closure $resolver): mixed
    {
        if (empty($user->supabase_id)) {
            return null;
        }

        $ttl = (int) config('supabase.subscriptions_cache_ttl', 60);

        if ($ttl <= 0) {
            return $resolver();
        }

        return Cache::remember("subs:{$key}:{$user->supabase_id}", $ttl, $resolver);
    }
}
