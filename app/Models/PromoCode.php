<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    protected $fillable = [
        'code',
        'discount_percent',
        'max_uses',
        'active',
        'expires_at',
        'created_by',
    ];

    protected $casts = [
        'active' => 'boolean',
        'expires_at' => 'datetime',
        'discount_percent' => 'integer',
        'max_uses' => 'integer',
    ];

    public function redemptions()
    {
        return $this->hasMany(PromoRedemption::class);
    }

    public function creator()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function isExpired(): bool
    {
        return $this->expires_at !== null && $this->expires_at->isPast();
    }
}
