<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoRedemption extends Model
{
    protected $fillable = [
        'promo_code_id',
        'user_id',
        'enrollment_id',
        'status',
        'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    public function promoCode()
    {
        return $this->belongsTo(PromoCode::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }
}
