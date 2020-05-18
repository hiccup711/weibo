<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
//    游客只能访问创建方法
    public function __construct()
    {
        $this->middleware('guest', [
            'only' => 'create'
        ]);
    }
//   用户登录界面
    public function create()
    {
        return view('sessions.create');
    }
//    用户登录表单验证
    public function store(Request $request)
    {
        $credential = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if(Auth::attempt($credential, $request->has('remember')))
        {
//            判断该用户是否激活
            if(Auth::user()->activated)
            {
                session()->flash('success', '欢迎回来~');
                $fallback = route('users.show', Auth::user()->id);
                return redirect()->intended($fallback);
            }
//            如果没激活向session添加 "activated"
            else{
                session()->put('activated', false);
                return redirect()->route('users.show', Auth::user()->id);
            }
        } else {
//            密码错误时的返回
            return redirect()->route('login')->withErrors('您的邮箱和密码不匹配')->withInput();
        }
    }
//    账号退出
    public function destroy()
    {
        Auth::logout();
        session()->forget('activated');
        session()->flash('success', '您的账号已退出');
        return redirect('/');
    }
}
