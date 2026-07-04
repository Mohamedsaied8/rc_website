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
}
