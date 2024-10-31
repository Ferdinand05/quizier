<?php

namespace App\Http\Middleware;

use App\Models\Quiz;
use Inertia\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'flash' => [
                'message' => fn() => $request->session()->get('message')
            ],
            'auth.user' => [
                'role_id' => Auth::user()?->role_id,
                'username' => Auth::user()?->username,
                'role' => Auth::user()?->role->nama_role
            ],
            'userAnswer' => $request->session()->get('userAnswer'),
            'countQuiz' => Quiz::count()
        ]);
    }
}
