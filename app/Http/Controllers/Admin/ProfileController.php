<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = Profile::first() ?? new Profile();
        return Inertia::render('Admin/Profile/Edit', ['profile' => $profile]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title_fr' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'bio_fr' => 'required|string',
            'bio_en' => 'required|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'github' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'available' => 'boolean',
            'years_experience' => 'integer|min:0',
            'avatar' => 'nullable|image|max:2048',
        ]);

        $profile = Profile::firstOrNew(['id' => 1]);

        if ($request->hasFile('avatar')) {
            // Delete old avatar
            if ($profile->avatar) {
                Storage::disk('public')->delete($profile->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        } else {
            unset($validated['avatar']);
        }

        $profile->fill($validated);
        $profile->save();

        return redirect()->route('admin.profile.edit')->with('success', 'Profil mis à jour!');
    }
}
