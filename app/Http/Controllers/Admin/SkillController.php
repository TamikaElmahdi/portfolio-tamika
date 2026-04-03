<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SkillController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Skill/Index', [
            'skills' => Skill::orderBy('category')->orderBy('order')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Skill/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:frontend,backend,tools,other',
            'icon' => 'nullable|string|max:255',
            'level' => 'required|integer|min:1|max:100',
            'order' => 'integer',
        ]);

        Skill::create($validated);
        return redirect()->route('admin.skills.index')->with('success', 'Compétence créée!');
    }

    public function edit(Skill $skill)
    {
        return Inertia::render('Admin/Skill/Edit', ['skill' => $skill]);
    }

    public function update(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:frontend,backend,tools,other',
            'icon' => 'nullable|string|max:255',
            'level' => 'required|integer|min:1|max:100',
            'order' => 'integer',
        ]);

        $skill->update($validated);
        return redirect()->route('admin.skills.index')->with('success', 'Compétence mise à jour!');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('admin.skills.index')->with('success', 'Compétence supprimée!');
    }
}
