<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'second_name',
        'last_name',
        'email',
        'phone',
        'country',
        'city',
        'education_level',
        'university',
        'graduation_year',
        'college',
        'experience',
        'motivation',
        'selected_program',
        'selected_course',
        'program_cohort_id',
        'preferred_schedule',
        'promo_code_id',
        'discount_percent',
        'original_amount',
        'payment_method',
        'payment_status',
        'gateway',
        'gateway_order_id',
        'gateway_transaction_id',
        'amount',
        'currency',
        'paid_at',
        'payment_screenshot',
        'additional_notes',
        'status',
        'admin_notes'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'paid_at' => 'datetime',
        'amount' => 'decimal:2',
        'original_amount' => 'decimal:2',
        'discount_percent' => 'integer',
    ];

    // Scope for filtering by status
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Scope for pending enrollments
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cohort()
    {
        return $this->belongsTo(ProgramCohort::class, 'program_cohort_id');
    }

    public function promoCode()
    {
        return $this->belongsTo(PromoCode::class);
    }

    public function manualPayments()
    {
        return $this->hasMany(ManualPayment::class);
    }

    public function latestManualPayment()
    {
        return $this->hasOne(ManualPayment::class)->latestOfMany();
    }
}
