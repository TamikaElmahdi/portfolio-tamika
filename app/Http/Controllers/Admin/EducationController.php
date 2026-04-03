<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EducationController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Education/Index', [
            'educations' => Education::orderBy('order')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Education/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'school' => 'required|string|max:255',
            'degree_fr' => 'required|string|max:255',
            'degree_en' => 'required|string|max:255',
            'field_fr' => 'required|string|max:255',
            'field_en' => 'required|string|max:255',
            'description_fr' => 'nullable|string',
            'description_en' => 'nullable|string',
            'start_year' => 'required|integer',
            'end_year' => 'nullable|integer',
            'order' => 'integer',
        ]);

        Education::create($validated);
        return redirect()->route('admin.educations.index')->with('success', 'Formation créée!');
    }

    public function edit(Education $education)
    {
        return Inertia::render('Admin/Education/Edit', ['education' => $education]);
    }

    public function update(Request $request, Education $education)
    {
        $validated = $request->validate([
            'school' => 'required|string|max:255',
            'degree_fr' => 'required|string|max:255',
            'degree_en' => 'required|string|max:255',
            'field_fr' => 'required|string|max:255',
            'field_en' => 'required|string|max:255',
            'description_fr' => 'nullable|string',
            'description_en' => 'nullable|string',
            'start_year' => 'required|integer',
            'end_year' => 'nullable|integer',
            'order' => 'integer',
        ]);

        $education->update($validated);
        return redirect()->route('admin.educations.index')->with('success', 'Formation mise à jour!');
    }

    public function destroy(Education $education)
    {
        $education->delete();
        return redirect()->route('admin.educations.index')->with('success', 'Formation supprimée!');
    }
}
