<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowersController extends Controller
{
    public function store(User $user)
    {
        if ($user->id === auth()->user()->id) {
            return redirect('/');
        }

        if (!auth()->user()->isFollowing($user->id)) {
            auth()->user()->follow($user->id);
        }

        return redirect()->route('users.show', $user);
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->user()->id) {
            return redirect('/');
        }

        if (auth()->user()->isFollowing($user->id)) {
            auth()->user()->unfollow($user->id);
        }

        return redirect()->route('users.show', $user);
    }
}
