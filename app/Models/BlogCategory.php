<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $fillable = ['name_fr', 'name_en', 'slug', 'color', 'order'];

    public function posts()
    {
        return $this->belongsToMany(BlogPost::class, 'blog_post_category');
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
