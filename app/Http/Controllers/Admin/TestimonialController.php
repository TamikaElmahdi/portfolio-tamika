<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class TestimonialController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Testimonial/Index', [
            'testimonials' => Testimonial::orderBy('order')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Testimonial/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'author_name'     => 'required|string|max:255',
            'author_position' => 'nullable|string|max:255',
            'author_company'  => 'nullable|string|max:255',
            'author_avatar'   => 'nullable|image|max:2048',
            'content_fr'      => 'required|string',
            'content_en'      => 'nullable|string',
            'rating'          => 'integer|min:1|max:5',
            'relation'        => 'nullable|string|max:100',
            'linkedin_url'    => 'nullable|url|max:500',
            'featured'        => 'boolean',
            'order'           => 'integer',
        ]);

        if ($request->hasFile('author_avatar')) {
            $validated['author_avatar'] = $request->file('author_avatar')->store('testimonials', 'public');
        }

        Testimonial::create($validated);
        return redirect()->route('admin.testimonials.index')->with('success', 'Témoignage créé!');
    }

    public function edit(Testimonial $testimonial)
    {
        return Inertia::render('Admin/Testimonial/Edit', ['testimonial' => $testimonial]);
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'author_name'     => 'required|string|max:255',
            'author_position' => 'nullable|string|max:255',
            'author_company'  => 'nullable|string|max:255',
            'author_avatar'   => 'nullable|image|max:2048',
            'content_fr'      => 'required|string',
            'content_en'      => 'nullable|string',
            'rating'          => 'integer|min:1|max:5',
            'relation'        => 'nullable|string|max:100',
            'linkedin_url'    => 'nullable|url|max:500',
            'featured'        => 'boolean',
            'order'           => 'integer',
        ]);

        if ($request->hasFile('author_avatar')) {
            if ($testimonial->author_avatar) {
                Storage::disk('public')->delete($testimonial->author_avatar);
            }
            $validated['author_avatar'] = $request->file('author_avatar')->store('testimonials', 'public');
        }

        $testimonial->update($validated);
        return redirect()->route('admin.testimonials.index')->with('success', 'Témoignage mis à jour!');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->author_avatar) {
            Storage::disk('public')->delete($testimonial->author_avatar);
        }
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Témoignage supprimé!');
    }
}
