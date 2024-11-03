<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\Result;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {

        return Inertia::render('Dashboard/User/UserView', [
            'users' => UserResource::collection(User::all()),
            'roles' => Role::all()
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

    public function update(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'alpha_num', Rule::unique('users', 'username')->ignore($request->id)],
            'name' => ['required', 'string', 'alpha'],
        ]);

        $user = User::whereId($request->id)->update([
            'username' => $request->username,
            'name' => $request->name,
            'role_id' => $request->role_id
        ]);

        return redirect()->back()->with('message', 'User berhasil di ubah!');
    }

    public function destroy($id)
    {
        $user = User::whereId($id)->first();
        Result::where('user_id', $id)->delete();
        Storage::delete('picture/' . $user->picture);
        $user->delete();

        return redirect()->back()->with('message', 'Data user berhasil di Hapus!');
    }
}
