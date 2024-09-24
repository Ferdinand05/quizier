<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeQuizController extends Controller
{
    public function index()
    {
        return Inertia::render('HomeQuiz/HomeQuizView');
    }
}
