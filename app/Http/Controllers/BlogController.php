<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::published()
            ->with(['categories', 'tags'])
            ->orderBy('published_at', 'desc');

        if ($request->filled('category')) {
            $query->whereHas('categories', fn($q) => $q->where('slug', $request->category));
        }

        if ($request->filled('tag')) {
            $query->whereHas('tags', fn($q) => $q->where('slug', $request->tag));
        }

        return Inertia::render('Blog/Index', [
            'posts'      => $query->paginate(9)->withQueryString(),
            'categories' => BlogCategory::orderBy('order')->get(),
            'tags'       => BlogTag::orderBy('name')->get(),
            'filters'    => $request->only(['category', 'tag']),
        ]);
    }

    public function show(BlogPost $post)
    {
        abort_unless($post->is_published, 404);

        $post->increment('views');

        $recommended = BlogPost::published()
            ->whereHas('categories', fn($q) => $q->whereIn(
                'blog_categories.id',
                $post->categories->pluck('id')
            ))
            ->where('id', '!=', $post->id)
            ->with(['categories', 'tags'])
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        return Inertia::render('Blog/Show', [
            'post'        => $post->load(['categories', 'tags']),
            'recommended' => $recommended,
        ]);
    }

    public function sitemap()
    {
        $posts = BlogPost::published()
            ->orderBy('published_at', 'desc')
            ->get(['slug', 'updated_at']);

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($posts as $post) {
            $xml .= '<url>';
            $xml .= '<loc>' . url('/blog/' . $post->slug) . '</loc>';
            $xml .= '<lastmod>' . $post->updated_at->toAtomString() . '</lastmod>';
            $xml .= '<changefreq>monthly</changefreq>';
            $xml .= '<priority>0.8</priority>';
            $xml .= '</url>';
        }

        $xml .= '</urlset>';

        return response($xml, 200, ['Content-Type' => 'application/xml']);
    }
}
