<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Project/Index', [
            'projects' => Project::orderBy('order')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Project/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_fr'       => 'required|string|max:255',
            'title_en'       => 'required|string|max:255',
            'description_fr' => 'required|string',
            'description_en' => 'required|string',
            'demo_url'       => 'nullable|url|max:255',
            'github_url'     => 'nullable|url|max:255',
            'technologies'   => 'nullable|array',
            'featured'       => 'boolean',
            'order'          => 'integer',
            'images'         => 'nullable|array',
            'images.*'       => 'image|max:4096',
        ]);

        $project = Project::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $path = $file->store('projects', 'public');
                $project->images()->create(['path' => $path, 'order' => $index]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Projet créé!');
    }

    public function edit(Project $project)
    {
        return Inertia::render('Admin/Project/Edit', [
            'project' => $project->load('images'),
        ]);
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title_fr'           => 'required|string|max:255',
            'title_en'           => 'required|string|max:255',
            'description_fr'     => 'required|string',
            'description_en'     => 'required|string',
            'demo_url'           => 'nullable|url|max:255',
            'github_url'         => 'nullable|url|max:255',
            'technologies'       => 'nullable|array',
            'featured'           => 'boolean',
            'order'              => 'integer',
            'deleted_image_ids'  => 'nullable|array',
            'deleted_image_ids.*' => 'integer',
            'images'             => 'nullable|array',
            'images.*'           => 'image|max:4096',
        ]);

        $project->update($validated);

        if (!empty($validated['deleted_image_ids'])) {
            $toDelete = $project->images()->whereIn('id', $validated['deleted_image_ids'])->get();
            foreach ($toDelete as $img) {
                Storage::disk('public')->delete($img->path);
                $img->delete();
            }
        }

        if ($request->hasFile('images')) {
            $nextOrder = $project->images()->max('order') + 1;
            foreach ($request->file('images') as $index => $file) {
                $path = $file->store('projects', 'public');
                $project->images()->create(['path' => $path, 'order' => $nextOrder + $index]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Projet mis à jour!');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Projet supprimé!');
    }
}
