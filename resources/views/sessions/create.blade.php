@extends('layout.default')
@section('title', '用户登录')
@section('content')
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h5>用户登录</h5>
            </div>
            <div class="card-body">
                @include('shared._errors')
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">邮箱</label>
                        <input type="text" name="email" value="{{ old('email') }}" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">密码</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember" class="form-check-label">记住我</label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">登录</button>
                        <a href="{{ route('password.request') }}" class="ml-2">忘记密码？</a>
                    </div>
                </form>
                <hr>
                <div>还没账号？ <a href="{{ route('users.create') }}" class="ml-2">现在注册</a></div>
            </div>
        </div>
    </div>
@stop
