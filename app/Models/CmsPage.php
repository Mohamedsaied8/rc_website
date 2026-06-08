<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'is_active',
        'sort_order',
        'is_custom',
        'custom_html',
    ];

    public function sections()
    {
        return $this->hasMany(CmsSection::class)->orderBy('sort_order');
    }

    public static function findBySlug($slug)
    {
        return static::where('slug', $slug)->where('is_active', true)->first();
    }
}
