<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramCohort extends Model
{
    protected $fillable = [
        'program_id',
        'group_name',
        'start_date',
        'schedule',
        'location',
        'fees',
        'is_active'
    ];

    protected $casts = [
        'start_date' => 'date',
        'is_active' => 'boolean',
        'fees' => 'decimal:2'
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
