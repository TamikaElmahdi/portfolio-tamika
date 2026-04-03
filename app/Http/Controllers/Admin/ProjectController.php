<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
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
            'title_fr' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_fr' => 'required|string',
            'description_en' => 'required|string',
            'demo_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'technologies' => 'nullable|array',
            'featured' => 'boolean',
            'order' => 'integer',
        ]);

        Project::create($validated);
        return redirect()->route('admin.projects.index')->with('success', 'Projet créé!');
    }

    public function edit(Project $project)
    {
        return Inertia::render('Admin/Project/Edit', ['project' => $project]);
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title_fr' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_fr' => 'required|string',
            'description_en' => 'required|string',
            'demo_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'technologies' => 'nullable|array',
            'featured' => 'boolean',
            'order' => 'integer',
        ]);

        $project->update($validated);
        return redirect()->route('admin.projects.index')->with('success', 'Projet mis à jour!');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Projet supprimé!');
    }
}
