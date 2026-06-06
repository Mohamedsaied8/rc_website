<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'description',
        'short_description',
        'duration',
        'price',
        'topics',
        'image',
        'video_url',
        'is_active',
        'currency',
        'sort_order'
    ];

    protected $casts = [
        'topics' => 'array',
        'is_active' => 'boolean',
        'price' => 'decimal:2'
    ];

    // Relationship with programs
    public function programs()
    {
        return $this->belongsToMany(Program::class, 'program_course')
                    ->withPivot('sort_order', 'is_required')
                    ->orderBy('pivot_sort_order');
    }
}
