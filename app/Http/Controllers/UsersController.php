<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
//    登录用户可以访问除 'create', 'store', 'confirmEmail' 以外的方法
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['create', 'store', 'confirmEmail']
        ]);
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }
//    所有用户列表
    public function index()
    {
        $title = '所有用户';
        $users = User::paginate(15);
        return view('users.index', compact('users', 'title'));
    }
//    用户注册界面
    public function create()
    {
        return view('users.create');
    }
//    用户表单验证
    public function store(Request $request)
    {
        $user = $this->validate($request, [
            'name' => 'required|alpha_dash|min:3|max:20',
            'email' => 'required|email|unique:users|',
            'password' => 'required|min:6|max:20|confirmed'
        ]);
        $user['password'] = bcrypt($user['password']);
        $user = User::create($user);
        session()->flash('success', '注册成功，请查看您的邮箱激活账号');
//        发送激活账号邮件
        $this->sendConfirmEmailTo($user);
        Auth::login($user);
        return redirect()->route('users.show', compact('user'));
    }
//    显示用户
    public function show(User $user)
    {
        $statuses = $user->statuses()->orderBy('created_at', 'desc')->paginate(15);
        return view('users.show', compact('user', 'statuses'));
    }
//    编辑用户
    public function edit(User $user)
    {
//        update策略验证
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }
    public function update(Request $request)
    {
//        update策略验证
        $this->authorize('update', $user);
        $this->validate($request, [
            'name' => 'required|alpha_dash|min:3|max:20',
            'password' => 'nullable|min:6|max:20|confirmed'
        ]);
        $data['name'] = $request['name'];
        if($request['password']){
            $data['password'] = bcrypt($request['password']);
        }
        Auth::user()->update($data);
        session()->flash('success', '更新成功');
        return redirect()->route('users.show', Auth::user()->id);
    }
//    删除用户
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('info', $user->name .'已被删除');
        return back();
    }
//    确认邮箱，激活账号
    public function confirmEmail($token)
    {
        $user = User::where('activation_token', $token)->firstOrFail();
        $user->activation_token = null;
        $user->activated = true;
        $user->email_verified_at = now();
        $user->save();
        Auth::login($user);
        session()->flash('success', '账号已激活，您将在这里开启一段新的旅程~');
        session()->forget('activated');
        return redirect()->route('users.show', compact('user'));
    }
//    发送邮件
    public function sendConfirmEmailTo($user)
    {
        $view = 'emails.confirm';
        $data = compact('user');
        $to = $user->email;
        $subject = '感谢您在WeiboApp注册';
//        参数1.邮件视图 2.视图数据 3.回调
        Mail::send($view, $data, function($message) use ($to, $subject){
            $message->to($to)->subject($subject);
        });
    }
//    重新发送邮件
    public function resendConfirmEmail()
    {
        $this->authorize('resend', Auth::user());
        $this->sendConfirmEmailTo(Auth::user());
        session()->flash('success', '激活邮件已重新发送，请查看您的邮箱');
        session()->forget('activated');
    }
}
