<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowersController extends Controller
{
//    只允许登录用户访问此控制器
    public function __construct()
    {
        $this->middleware('auth');
    }
//    获取用户的粉丝列表
    public function followers(User $user)
    {
        $users = $user->followers()->paginate(15);
        $title = $user->name .'的粉丝';
        return view('users.index', compact('users', 'title'));
    }
//    获取用户的关注列表
    public function followings(User $user)
    {
        $users = $user->followings()->paginate(15);
        $title = $user->name .'的关注';
        return view('users.index', compact('users', 'title'));
    }
//    关注用户
    public function follow(User $user)
    {
        $this->authorize('follow', $user);
        if(!Auth::user()->isFollowing($user))
        {
            Auth::user()->follow($user->id);
        }
        return redirect()->route('users.show', $user->id);
    }
//    取关用户
    public function unfollow(User $user)
    {
        if(Auth::user()->isFollowing($user))
        {
            Auth::user()->unfollow($user->id);
        }
        return redirect()->route('users.show', $user->id);
    }
}
