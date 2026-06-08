<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'cms_page_id',
        'name',
        'slug',
        'description',
        'sort_order',
        'is_active',
    ];

    public function page()
    {
        return $this->belongsTo(CmsPage::class, 'cms_page_id');
    }

    public function blocks()
    {
        return $this->hasMany(CmsBlock::class)->orderBy('sort_order');
    }

    public function block($key, $default = null)
    {
        $block = $this->blocks()->where('key', $key)->first();
        return $block ? $block->value : $default;
    }
}
