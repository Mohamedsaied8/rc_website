<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PromoCode;
use App\Services\PromoCodeService;
use Illuminate\Http\Request;

class PromoCodeController extends Controller
{
    public function __construct(private PromoCodeService $promoCodes)
    {
    }

    public function index()
    {
        $codes = PromoCode::withCount([
            'redemptions',
            'redemptions as completed_redemptions_count' => fn ($q) => $q->where('status', 'completed'),
        ])->latest()->paginate(15);

        return view('admin.promo-codes.index', compact('codes'));
    }

    public function create()
    {
        return view('admin.promo-codes.create');
    }

    public function store(Request $request)
    {
        // Blank code → autogenerate. Normalise before the unique check so
        // "summer10" and "SUMMER10" can't coexist.
        if ($request->filled('code')) {
            $request->merge(['code' => $this->promoCodes->normalize($request->code)]);
        }

        $request->validate([
            'code' => 'nullable|string|min:3|max:64|alpha_num:ascii|unique:promo_codes,code',
            'discount_percent' => 'required|integer|min:1|max:100',
            'max_uses' => 'nullable|integer|min:1',
            'expires_at' => 'nullable|date|after:now',
        ]);

        $promo = PromoCode::create([
            'code' => $request->filled('code') ? $request->code : $this->promoCodes->generateCode(),
            'discount_percent' => $request->discount_percent,
            'max_uses' => $request->max_uses,
            'active' => true,
            'expires_at' => $request->expires_at,
            'created_by' => auth('admin')->id(),
        ]);

        return redirect()->route('admin.promo-codes.index')
            ->with('success', "Promo code {$promo->code} created ({$promo->discount_percent}% off).");
    }

    public function update(Request $request, PromoCode $promoCode)
    {
        // Toggle-only requests carry just `active`; the edit form sends the rest.
        $request->validate([
            'active' => 'nullable|boolean',
            'max_uses' => 'nullable|integer|min:1',
            'expires_at' => 'nullable|date',
        ]);

        $data = [];
        if ($request->has('active')) {
            $data['active'] = $request->boolean('active');
        }
        if ($request->exists('max_uses')) {
            $data['max_uses'] = $request->max_uses;
        }
        if ($request->exists('expires_at')) {
            $data['expires_at'] = $request->expires_at;
        }

        $promoCode->update($data);

        return redirect()->route('admin.promo-codes.index')
            ->with('success', "Promo code {$promoCode->code} updated.");
    }

    public function destroy(PromoCode $promoCode)
    {
        if ($promoCode->redemptions()->exists()) {
            return back()->with('error', 'This code has redemptions and cannot be deleted. Deactivate it instead.');
        }

        $promoCode->delete();

        return redirect()->route('admin.promo-codes.index')
            ->with('success', "Promo code {$promoCode->code} deleted.");
    }
}
