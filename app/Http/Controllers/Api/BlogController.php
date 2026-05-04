<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_fr'           => 'required|string|max:255',
            'title_en'           => 'required|string|max:255',
            'slug'               => 'nullable|string|max:255',
            'excerpt_fr'         => 'nullable|string',
            'excerpt_en'         => 'nullable|string',
            'content_fr'         => 'nullable|string',
            'content_en'         => 'nullable|string',
            'meta_title_fr'      => 'nullable|string|max:255',
            'meta_title_en'      => 'nullable|string|max:255',
            'meta_description_fr'=> 'nullable|string',
            'meta_description_en'=> 'nullable|string',
        ]);

        // Auto-generate slug from french title
        $validated['slug'] = Str::slug($validated['title_fr']);

        // Make slug unique
        $original = $validated['slug'];
        $count = 1;
        while (BlogPost::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $original . '-' . $count++;
        }

        // Auto-calculate reading time (avg 200 words/min)
        $wordCount = str_word_count(strip_tags($validated['content_fr'] ?? ''));
        $validated['reading_time'] = max(1, round($wordCount / 200));

        // Auto-publish
        $validated['is_published'] = true;
        $validated['published_at'] = now();

        $blog = BlogPost::create($validated);

        return response()->json([
            'success' => true,
            'blog'    => $blog
        ], 201);
    }
}