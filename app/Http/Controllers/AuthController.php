<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function index()
    {

        return Inertia::render('Auth/LoginView');
    }

    public function store() {}

    public function register()
    {
        return Inertia::render('Auth/RegisterView');
    }

    public function registerStore() {}
}
