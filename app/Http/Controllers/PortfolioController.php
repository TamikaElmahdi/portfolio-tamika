<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Hobby;
use App\Models\Message;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PortfolioController extends Controller
{
    public function index(Request $request): Response
    {
        $locale = $request->get('lang', app()->getLocale());
        app()->setLocale($locale);

        $profile = Profile::first();
        $experiences = Experience::orderBy('order')->orderBy('start_date', 'desc')->get();
        $educations = Education::orderBy('order')->orderBy('start_year', 'desc')->get();
        $skills = Skill::orderBy('order')->get()->groupBy('category');
        $certificates = Certificate::orderBy('order')->orderBy('issued_date', 'desc')->get();
        $hobbies = Hobby::orderBy('order')->get();
        $projects = Project::with('images')->orderBy('order')->get();
        $testimonials = Testimonial::orderBy('order')->get();

        return Inertia::render('Portfolio/Home', [
            'profile' => $profile,
            'experiences' => $experiences,
            'educations' => $educations,
            'skills' => $skills,
            'certificates' => $certificates,
            'hobbies' => $hobbies,
            'projects' => $projects,
            'testimonials' => $testimonials,
            'locale' => $locale,
        ]);
    }

    public function setLocale(Request $request)
    {
        $locale = $request->get('locale', 'fr');
        if (in_array($locale, ['fr', 'en'])) {
            session(['locale' => $locale]);
        }
        return redirect()->back();
    }

    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Message::create($validated);

        return redirect()->back()->with('success', 'Message envoyé avec succès!');
    }
}
