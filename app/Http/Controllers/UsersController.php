<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['create', 'store', 'confirmEmail']
        ]);
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }
    public function index()
    {
        $title = '所有用户';
        $users = User::paginate(15);
        return view('users.index', compact('users', 'title'));
    }
    public function create()
    {
        return view('users.create');
    }
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
        $this->sendConfirmEmailTo($user);
        Auth::login($user);
        return redirect()->route('users.show', compact('user'));
    }
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }
    public function update(Request $request)
    {
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
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('info', $user->name .'已被删除');
        return back();
    }
    public function confirmEmail($token)
    {
        $user = User::where('activation_token', $token)->firstOrFail();
        $user->activation_token = null;
        $user->activated = true;
        $user->email_verified_at = now();
        $user->save();
        Auth::login($user);
        session()->flash('success', '账号已激活，您将在这里开启一段新的旅程~');
        return redirect()->route('users.show', compact('user'));
    }
    public function sendConfirmEmailTo($user)
    {
        $view = 'emails.confirm';
        $data = compact('user');
        $from = '43733717@qq.com';
        $name = 'Ricky';
        $to = $user->email;
        $subject = '感谢您在WeiboApp注册';
        Mail::send($view, $data, function($message) use ($from, $name, $to, $subject){
            $message->from($from, $name)->to($to)->subject($subject);
        });
    }
}
