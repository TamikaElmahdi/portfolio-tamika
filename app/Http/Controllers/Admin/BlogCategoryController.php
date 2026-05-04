<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class BlogCategoryController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/BlogCategory/Index', [
            'categories' => BlogCategory::withCount('posts')->orderBy('order')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/BlogCategory/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_fr' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'slug'    => 'nullable|string|max:255|unique:blog_categories,slug',
            'color'   => 'nullable|string|max:20',
            'order'   => 'integer',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name_fr']);
        }

        BlogCategory::create($validated);

        return redirect()->route('admin.blog-categories.index')->with('success', 'Catégorie créée !');
    }

    public function edit(BlogCategory $blogCategory)
    {
        return Inertia::render('Admin/BlogCategory/Edit', [
            'category' => $blogCategory,
        ]);
    }

    public function update(Request $request, BlogCategory $blogCategory)
    {
        $validated = $request->validate([
            'name_fr' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'slug'    => ['nullable', 'string', 'max:255', Rule::unique('blog_categories', 'slug')->ignore($blogCategory->id)],
            'color'   => 'nullable|string|max:20',
            'order'   => 'integer',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name_fr']);
        }

        $blogCategory->update($validated);

        return redirect()->route('admin.blog-categories.index')->with('success', 'Catégorie mise à jour !');
    }

    public function destroy(BlogCategory $blogCategory)
    {
        $blogCategory->delete();

        return redirect()->route('admin.blog-categories.index')->with('success', 'Catégorie supprimée !');
    }
}
