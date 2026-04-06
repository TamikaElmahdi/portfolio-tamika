<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'author_name', 'author_position', 'author_company', 'author_avatar',
        'content_fr', 'content_en', 'rating', 'relation', 'linkedin_url',
        'featured', 'order',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'rating' => 'integer',
        'order' => 'integer',
    ];
}
