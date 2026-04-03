<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CertificateController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Certificate/Index', [
            'certificates' => Certificate::orderBy('order')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Certificate/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_fr' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'issued_date' => 'required|date',
            'expiry_date' => 'nullable|date',
            'credential_url' => 'nullable|url|max:255',
            'description_fr' => 'nullable|string',
            'description_en' => 'nullable|string',
            'order' => 'integer',
        ]);

        Certificate::create($validated);
        return redirect()->route('admin.certificates.index')->with('success', 'Certificat créé!');
    }

    public function edit(Certificate $certificate)
    {
        return Inertia::render('Admin/Certificate/Edit', ['certificate' => $certificate]);
    }

    public function update(Request $request, Certificate $certificate)
    {
        $validated = $request->validate([
            'title_fr' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'issued_date' => 'required|date',
            'expiry_date' => 'nullable|date',
            'credential_url' => 'nullable|url|max:255',
            'description_fr' => 'nullable|string',
            'description_en' => 'nullable|string',
            'order' => 'integer',
        ]);

        $certificate->update($validated);
        return redirect()->route('admin.certificates.index')->with('success', 'Certificat mis à jour!');
    }

    public function destroy(Certificate $certificate)
    {
        $certificate->delete();
        return redirect()->route('admin.certificates.index')->with('success', 'Certificat supprimé!');
    }
}
