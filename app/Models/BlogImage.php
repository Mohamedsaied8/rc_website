<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogImage extends Model
{
    protected $fillable = [
        'blog_post_id',
        'image_path',
        'caption',
        'order'
    ];

    /**
     * Get the blog post that owns the image.
     */
    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class);
    }
}
