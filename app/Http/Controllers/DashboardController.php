<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Quiz;
use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render(
            'Dashboard/DashboardView',
            [
                'userCount' => User::count(),
                'quizCount' => Quiz::count(),
                'categoryQuizCount' => Category::count(),
                'resultCount' => Result::count()
            ]
        );
    }
}
