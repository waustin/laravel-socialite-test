<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserUpdate;
use Illuminate\Support\Facades\Storage;

use App\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return view('users.index', [
            'users' => User::get()
        ]);
    }

    public function show(Request $request, User $user) 
    {
       // dd(Storage::url($user->profile_pic));
        $can_edit = false;
        if(Auth::user() == $user) {
            $can_edit = true;
        }
        return view('users.show', [
            'user' => $user, 
            'can_edit' => $can_edit
        ]);
    }

    public function update(UserUpdate $request, User $user)
    {
        $validated = $request->validated();
        $user->update([
            'name' => $validated['name']
        ]);

        // Upload the file if we have one
        if( isset($validated['profile_pic']) ) {
            $public_disk='s3';
            $user->profile_pic = $request->file('profile_pic')->store('user/profile_pics', [
                                                'disk' => $public_disk]);
            $user->save();
        }

        return redirect(route('users.index'));
    }
}
