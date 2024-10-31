<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {

        return Inertia::render('Dashboard/User/UserView', [
            'users' => UserResource::collection(User::all())
        ]);
    }
    public function profile(Request $request)
    {
        $user = Auth::user();
        return Inertia::render('Dashboard/User/ProfileView', [
            'user' => $user
        ]);
    }

    public function updatePicture(Request $request)
    {
        $request->validate([
            'picture' => 'image'
        ]);

        $pictureFile = $request->file("picture");
        if ($pictureFile) {
            $pictureEkstension = $pictureFile->getClientOriginalExtension();
            $name = Str::random(20);
            $picture = $name . '.' . $pictureEkstension;
            $pictureFile->storeAs('picture', $picture);
        } else {
            $picture = Auth::user()->picture;
        }


        auth()->user()->update([
            'picture' => $picture
        ]);


        return redirect()->back()->with('message', 'User Profile Picture berhasil di ubah!');
    }
}
