<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ExperienceController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Experience/Index', [
            'experiences' => Experience::orderBy('order')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Experience/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'position_fr' => 'required|string|max:255',
            'position_en' => 'required|string|max:255',
            'description_fr' => 'required|string',
            'description_en' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'is_current' => 'boolean',
            'location' => 'nullable|string|max:255',
            'contract_type' => 'nullable|string|max:100',
            'order' => 'integer',
        ]);

        Experience::create($validated);
        return redirect()->route('admin.experiences.index')->with('success', 'Expérience créée!');
    }

    public function edit(Experience $experience)
    {
        return Inertia::render('Admin/Experience/Edit', ['experience' => $experience]);
    }

    public function update(Request $request, Experience $experience)
    {
        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'position_fr' => 'required|string|max:255',
            'position_en' => 'required|string|max:255',
            'description_fr' => 'required|string',
            'description_en' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'is_current' => 'boolean',
            'location' => 'nullable|string|max:255',
            'contract_type' => 'nullable|string|max:100',
            'order' => 'integer',
        ]);

        $experience->update($validated);
        return redirect()->route('admin.experiences.index')->with('success', 'Expérience mise à jour!');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();
        return redirect()->route('admin.experiences.index')->with('success', 'Expérience supprimée!');
    }
}
