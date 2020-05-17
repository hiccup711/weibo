<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function followers(User $user)
    {
        $users = $user->followers()->paginate(15);
        $title = $user->name .'的粉丝';
        return view('users.index', compact('users', 'title'));
    }
    public function followings(User $user)
    {
        $users = $user->followings()->paginate(15);
        $title = $user->name .'的关注';
        return view('users.index', compact('users', 'title'));
    }
    public function follow(User $user)
    {
        $this->authorize('follow', $user);
        if(!Auth::user()->isFollowing($user))
        {
            Auth::user()->follow($user->id);
        }
        return redirect()->route('users.show', $user->id);
    }
    public function unfollow(User $user)
    {
        if(Auth::user()->isFollowing($user))
        {
            Auth::user()->unfollow($user->id);
        }
        return redirect()->route('users.show', $user->id);
    }
}
