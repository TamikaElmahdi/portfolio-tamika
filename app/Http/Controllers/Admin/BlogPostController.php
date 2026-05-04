<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class BlogPostController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Blog/Index', [
            'posts' => BlogPost::with(['categories', 'tags'])
                ->orderBy('order')
                ->orderBy('created_at', 'desc')
                ->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Blog/Create', [
            'categories' => BlogCategory::orderBy('order')->get(),
            'tags'       => BlogTag::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_fr'            => 'required|string|max:255',
            'title_en'            => 'required|string|max:255',
            'slug'                => 'nullable|string|max:255|unique:blog_posts,slug',
            'excerpt_fr'          => 'nullable|string',
            'excerpt_en'          => 'nullable|string',
            'content_fr'          => 'nullable|string',
            'content_en'          => 'nullable|string',
            'cover_image'         => 'nullable|image|max:4096',
            'og_image'            => 'nullable|image|max:4096',
            'reading_time'        => 'nullable|integer|min:1',
            'is_published'        => 'boolean',
            'published_at'        => 'nullable|date',
            'meta_title_fr'       => 'nullable|string|max:255',
            'meta_title_en'       => 'nullable|string|max:255',
            'meta_description_fr' => 'nullable|string|max:500',
            'meta_description_en' => 'nullable|string|max:500',
            'order'               => 'integer',
            'category_ids'        => 'nullable|array',
            'category_ids.*'      => 'integer|exists:blog_categories,id',
            'tags'                => 'nullable|string',
        ]);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('blog', 'public');
        }

        if ($request->hasFile('og_image')) {
            $validated['og_image'] = $request->file('og_image')->store('blog', 'public');
        }

        if ($validated['is_published'] && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $post = BlogPost::create($validated);

        if (!empty($validated['category_ids'])) {
            $post->categories()->sync($validated['category_ids']);
        }

        $this->syncTags($post, $request->input('tags', ''));

        return redirect()->route('admin.blog.index')->with('success', 'Article créé !');
    }

    public function edit(BlogPost $blog)
    {
        return Inertia::render('Admin/Blog/Edit', [
            'post'       => $blog->load(['categories', 'tags']),
            'categories' => BlogCategory::orderBy('order')->get(),
            'tags'       => BlogTag::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, BlogPost $blog)
    {
        $validated = $request->validate([
            'title_fr'            => 'required|string|max:255',
            'title_en'            => 'required|string|max:255',
            'slug'                => ['nullable', 'string', 'max:255', Rule::unique('blog_posts', 'slug')->ignore($blog->id)],
            'excerpt_fr'          => 'nullable|string',
            'excerpt_en'          => 'nullable|string',
            'content_fr'          => 'nullable|string',
            'content_en'          => 'nullable|string',
            'cover_image'         => 'nullable|image|max:4096',
            'og_image'            => 'nullable|image|max:4096',
            'reading_time'        => 'nullable|integer|min:1',
            'is_published'        => 'boolean',
            'published_at'        => 'nullable|date',
            'meta_title_fr'       => 'nullable|string|max:255',
            'meta_title_en'       => 'nullable|string|max:255',
            'meta_description_fr' => 'nullable|string|max:500',
            'meta_description_en' => 'nullable|string|max:500',
            'order'               => 'integer',
            'category_ids'        => 'nullable|array',
            'category_ids.*'      => 'integer|exists:blog_categories,id',
            'tags'                => 'nullable|string',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($blog->cover_image) {
                Storage::disk('public')->delete($blog->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('blog', 'public');
        }

        if ($request->hasFile('og_image')) {
            if ($blog->og_image) {
                Storage::disk('public')->delete($blog->og_image);
            }
            $validated['og_image'] = $request->file('og_image')->store('blog', 'public');
        }

        if ($validated['is_published'] && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $blog->update($validated);

        $blog->categories()->sync($validated['category_ids'] ?? []);

        $this->syncTags($blog, $request->input('tags', ''));

        return redirect()->route('admin.blog.index')->with('success', 'Article mis à jour !');
    }

    public function destroy(BlogPost $blog)
    {
        if ($blog->cover_image) {
            Storage::disk('public')->delete($blog->cover_image);
        }
        if ($blog->og_image) {
            Storage::disk('public')->delete($blog->og_image);
        }

        $blog->delete();

        return redirect()->route('admin.blog.index')->with('success', 'Article supprimé !');
    }

    private function syncTags(BlogPost $post, string $tagInput): void
    {
        $names = array_filter(array_map('trim', explode(',', $tagInput)));
        $tagIds = [];

        foreach ($names as $name) {
            $tag = BlogTag::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name]
            );
            $tagIds[] = $tag->id;
        }

        $post->tags()->sync($tagIds);
    }
}
