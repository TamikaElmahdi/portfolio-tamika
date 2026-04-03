<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Hobby;
use App\Models\Message;
use App\Models\Project;
use App\Models\Skill;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Dashboard', [
            'counts' => [
                'experiences' => Experience::count(),
                'educations' => Education::count(),
                'skills' => Skill::count(),
                'certificates' => Certificate::count(),
                'hobbies' => Hobby::count(),
                'projects' => Project::count(),
                'messages' => Message::count(),
                'unread_messages' => Message::whereNull('read_at')->count(),
            ],
        ]);
    }
}
