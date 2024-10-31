<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function index()
    {

        return Inertia::render('Auth/LoginView');
    }

    public function store(Request $request)
    {


        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


        if (Auth::attempt($request->only('email', 'password'), $request->remember_me)) {
            return to_route('home')->with('message', 'Anda berhasil masuk!');
        }

        throw ValidationException::withMessages([
            'email' => 'Kredensial anda tidak sesuai'
        ]);
    }

    public function register()
    {
        return Inertia::render('Auth/RegisterView');
    }

    public function registerStore(Request $request)
    {

        $request->validate([
            'email' => ['email', 'required', 'unique:users,email'],
            'username' => ['required', 'string', 'unique:users,username', 'alpha_num'],
            'name' => ['required', 'string', 'alpha'],
            'password' => ['required', 'min:7', 'confirmed']
        ]);

        User::create([
            'email' => $request->email,
            'username' => $request->username,
            'name' => $request->name,
            'role_id' => 3,
            'password' => $request->password
        ]);

        return to_route('login')->with('message', 'Akun berhasil Di daftarkan!');
    }

    public function logout()
    {
        Auth::logout();
        return to_route('home')->with('message', 'Anda berhasil Logout');
    }
}
