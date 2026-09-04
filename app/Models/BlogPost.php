<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    public const TYPE_BLOG = 'blog';
    public const TYPE_NEWS = 'news';
    public const TYPE_PAPER = 'paper';

    public const TYPES = [self::TYPE_BLOG, self::TYPE_NEWS, self::TYPE_PAPER];

    protected $fillable = [
        'title',
        'slug',
        'type',
        'excerpt',
        'content',
        'featured_image',
        'author',
        'user_id',
        'status',
        'featured',
        'tags',
        'rejection_reason',
        'published_at',
        'paper_authors',
        'paper_abstract',
        'paper_venue',
        'paper_year',
        'paper_doi',
        'paper_url',
        'paper_pdf',
        'paper_code_url',
        'paper_bibtex',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'featured' => 'boolean',
        'tags' => 'array',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = static::uniqueSlug($post->title);
            }
        });
    }

    /**
     * Build a slug that doesn't collide with an existing post.
     */
    public static function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'post';
        $slug = $base;
        $i = 2;

        while (static::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

    /**
     * Get the images for the blog post.
     */
    public function images()
    {
        return $this->hasMany(BlogImage::class)->orderBy('order');
    }

    /**
     * The site user who submitted this post (null for admin-authored content).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include published posts.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope a query to only include draft posts.
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Scope a query to posts awaiting admin review.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to a single content type.
     */
    public function scopeOfType($query, ?string $type)
    {
        return in_array($type, self::TYPES, true) ? $query->where('type', $type) : $query;
    }

    /**
     * Get the reading time in minutes.
     */
    public function getReadingTimeAttribute()
    {
        $wordCount = str_word_count(strip_tags($this->content));
        $minutes = ceil($wordCount / 200); // Average reading speed
        return max(1, $minutes);
    }

    /**
     * Get the formatted published date.
     */
    public function getFormattedDateAttribute()
    {
        return $this->published_at ? $this->published_at->format('M d, Y') : null;
    }

    /**
     * Is this a published paper?
     */
    public function getIsPaperAttribute(): bool
    {
        return $this->type === self::TYPE_PAPER;
    }

    /**
     * Human label for the content type.
     */
    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            self::TYPE_NEWS => 'News',
            self::TYPE_PAPER => 'Paper',
            default => 'Blog',
        };
    }

    /**
     * Font Awesome icon for the content type.
     */
    public function getTypeIconAttribute(): string
    {
        return match ($this->type) {
            self::TYPE_NEWS => 'fa-solid fa-bullhorn',
            self::TYPE_PAPER => 'fa-solid fa-flask-vial',
            default => 'fa-solid fa-pen-nib',
        };
    }

    /**
     * Public URL for this post.
     */
    public function getUrlAttribute(): string
    {
        return route('blog.show', $this->slug);
    }

    /**
     * Render post markdown to HTML with raw HTML stripped — site users author blog
     * posts, so their content can never be trusted to be safe.
     *
     * Editor previews call this too, so what an author sees before submitting is
     * byte-for-byte what the published page will render.
     */
    public static function renderMarkdown(?string $markdown): string
    {
        return Str::markdown($markdown ?? '', [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);
    }

    /**
     * Rendered body.
     */
    public function getBodyHtmlAttribute(): string
    {
        return static::renderMarkdown($this->content);
    }

    /**
     * Byline: the account name for user submissions, the free-text author otherwise.
     */
    public function getBylineAttribute(): string
    {
        return $this->user?->name ?: ($this->author ?: 'Robotics Corner');
    }

    /**
     * Get the route key name for Laravel.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
