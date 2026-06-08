<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsBlock extends Model
{
    use HasFactory;

    protected $fillable = [
        'cms_section_id',
        'key',
        'value',
        'type',
        'label',
        'placeholder',
        'sort_order',
    ];

    public function section()
    {
        return $this->belongsTo(CmsSection::class, 'cms_section_id');
    }
}
