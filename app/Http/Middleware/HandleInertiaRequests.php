<?php

namespace App\Http\Middleware;

use App\Models\Profile;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    public function share(Request $request): array
    {
        $profile = Profile::first();

        return array_merge(parent::share($request), [
            'locale' => app()->getLocale(),
            'profile' => $profile ? [
                'id' => $profile->id,
                'name' => $profile->name,
                'title_fr' => $profile->title_fr,
                'title_en' => $profile->title_en,
                'email' => $profile->email,
                'github' => $profile->github,
                'linkedin' => $profile->linkedin,
                'available' => $profile->available,
            ] : null,
            'auth' => [
                'user' => $request->user() ? [
                    'id' => $request->user()->id,
                    'name' => $request->user()->name,
                    'email' => $request->user()->email,
                ] : null,
            ],
        ]);
    }
}
