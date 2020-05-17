@extends('layout.default')
@section('title', '用户注册')
@section('content')
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h5>用户注册</h5>
            </div>
            <div class="card-body">
                @include('shared._errors')
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">名称</label>
                        <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">邮箱</label>
                        <input type="text" name="email" value="{{ old('email') }}" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">密码</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password_confirm">确认密码</label>
                        <input type="password" name="password_confirmation" id="password_confirm" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">注册</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
