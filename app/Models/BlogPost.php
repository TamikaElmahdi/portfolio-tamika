<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    protected $fillable = [
        'title_fr', 'title_en', 'slug', 'excerpt_fr', 'excerpt_en',
        'content_fr', 'content_en', 'cover_image', 'reading_time',
        'is_published', 'published_at', 'meta_title_fr', 'meta_title_en',
        'meta_description_fr', 'meta_description_en', 'og_image', 'views', 'order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function categories()
    {
        return $this->belongsToMany(BlogCategory::class, 'blog_post_category');
    }

    public function tags()
    {
        return $this->belongsToMany(BlogTag::class, 'blog_post_tag');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->where(function ($q) {
                $q->whereNull('published_at')->orWhere('published_at', '<=', now());
            });
    }

    public function getReadingTimeAttribute(): int
    {
        if (!empty($this->attributes['reading_time'])) {
            return (int) $this->attributes['reading_time'];
        }
        $content = strip_tags($this->attributes['content_fr'] ?? '');
        $wordCount = str_word_count($content);
        return max(1, (int) ceil($wordCount / 200));
    }

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title_fr);
            }
        });
    }

    public function trans(string $field): string
    {
        $locale = app()->getLocale();
        $localizedField = $field . '_' . $locale;
        if (isset($this->attributes[$localizedField])) {
            return $this->attributes[$localizedField] ?? '';
        }
        return $this->attributes[$field . '_fr'] ?? '';
    }
}
