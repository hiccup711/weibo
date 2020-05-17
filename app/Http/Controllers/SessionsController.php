<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', [
            'only' => 'create'
        ]);
    }

    public function create()
    {
        return view('sessions.create');
    }
    public function store(Request $request)
    {
        $credential = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if(Auth::attempt($credential, $request->has('remember')))
        {
            if(Auth::user()->activated)
            {
                session()->flash('success', '欢迎回来~');
                $fallback = route('users.show', Auth::user()->id);
                return redirect()->intended($fallback);
            }
            else{
                session()->put('activated', false);
                return redirect()->route('users.show', Auth::user()->id);
            }
        } else {
            return redirect()->route('login')->withErrors('您的邮箱和密码不匹配')->withInput();
        }
    }
    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '您的账号已退出');
        session()->flush();
        return redirect('/');
    }
}
