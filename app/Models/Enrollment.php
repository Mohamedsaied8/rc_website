<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'country',
        'city',
        'education_level',
        'experience',
        'motivation',
        'selected_program',
        'preferred_schedule',
        'payment_method',
        'payment_screenshot',
        'additional_notes',
        'status',
        'admin_notes'
    ];

    protected $casts = [
        'is_active' => 'boolean',
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

    // Scope for approved enrollments
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}
