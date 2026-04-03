<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hobby;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HobbyController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Hobby/Index', [
            'hobbies' => Hobby::orderBy('order')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Hobby/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_fr' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'icon' => 'nullable|string|max:100',
            'color' => 'nullable|string|max:50',
            'order' => 'integer',
        ]);

        Hobby::create($validated);
        return redirect()->route('admin.hobbies.index')->with('success', 'Loisir créé!');
    }

    public function edit(Hobby $hobby)
    {
        return Inertia::render('Admin/Hobby/Edit', ['hobby' => $hobby]);
    }

    public function update(Request $request, Hobby $hobby)
    {
        $validated = $request->validate([
            'name_fr' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'icon' => 'nullable|string|max:100',
            'color' => 'nullable|string|max:50',
            'order' => 'integer',
        ]);

        $hobby->update($validated);
        return redirect()->route('admin.hobbies.index')->with('success', 'Loisir mis à jour!');
    }

    public function destroy(Hobby $hobby)
    {
        $hobby->delete();
        return redirect()->route('admin.hobbies.index')->with('success', 'Loisir supprimé!');
    }
}
