<?php

namespace App\Services\Payments;

use App\Models\Enrollment;
use App\Models\Program;
use App\Models\ProgramCohort;
use RuntimeException;

/**
 * Single source of truth for what an enrollment costs.
 *
 * This used to live on PaymobService, which meant the gateway decided the
 * price — and the controller had to reach back into the gateway to re-check the
 * webhook amount. Pricing is domain logic; it belongs here.
 */
class EnrollmentPricing
{
    public const CURRENCY = 'EGP';

    /**
     * Authoritative price for an enrollment, in decimal major units.
     *
     * The cohort fee wins when a cohort is attached, but ONLY when that cohort
     * genuinely belongs to the selected program. Previously the two were
     * validated independently, so pairing an expensive program with a cheap
     * cohort's id charged the cheap fee — and because the webhook's amount check
     * called this same method, it confirmed the manipulated amount as correct.
     */
    public function amountFor(Enrollment $enrollment): float
    {
        $program = Program::where('slug', $enrollment->selected_program)->first();

        $cohort = $enrollment->cohort;
        if ($cohort) {
            if (! $program || (int) $cohort->program_id !== (int) $program->id) {
                throw new RuntimeException(
                    "Enrollment {$enrollment->id}: cohort {$cohort->id} does not belong to program "
                    . "'{$enrollment->selected_program}'. Refusing to price."
                );
            }

            $base = $this->round((float) $cohort->fees);
        } else {
            $base = $this->round((float) ($program->price ?? 0));
        }

        // The percent stored ON the enrollment is authoritative, not the live
        // promo row — a later edit to the promo must not change what a webhook
        // replay expects to have been charged.
        return $this->applyDiscount($base, $enrollment->discount_percent);
    }

    /**
     * Percentage discount with a 1.00 EGP floor — gateways reject zero-amount
     * orders, so even a 100% code charges a symbolic pound.
     */
    public function applyDiscount(float $amount, ?int $percent): float
    {
        if (! $percent || $percent < 1 || $amount <= 0) {
            return $this->round($amount);
        }

        $discounted = $this->round($amount * (100 - min($percent, 100)) / 100);

        return max($discounted, 1.00);
    }

    /**
     * Does this cohort belong to this program slug? Used at validation time so
     * a mismatch is rejected before an enrollment row is ever created.
     */
    public function cohortBelongsToProgram(?int $cohortId, ?string $programSlug): bool
    {
        if (! $cohortId || ! $programSlug) {
            return false;
        }

        $program = Program::where('slug', $programSlug)->first();
        if (! $program) {
            return false;
        }

        return ProgramCohort::where('id', $cohortId)
            ->where('program_id', $program->id)
            ->exists();
    }

    /**
     * Canonical amount string.
     *
     * Kashier's order hash is computed over a literal string, so the value we
     * sign and the value we send must be byte-identical — "20" and "20.00" hash
     * differently. Everything that touches an amount goes through here.
     */
    public function format(float $amount): string
    {
        return number_format($this->round($amount), 2, '.', '');
    }

    /** Compare a gateway-reported amount to our expectation, tolerant of float noise. */
    public function matches(float $expected, float $reported): bool
    {
        return abs($this->round($expected) - $this->round($reported)) < 0.005;
    }

    private function round(float $amount): float
    {
        return round($amount, 2);
    }
}
