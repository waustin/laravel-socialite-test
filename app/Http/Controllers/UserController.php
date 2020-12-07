<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserUpdate;

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

        return redirect(route('users.index'));
    }
}
