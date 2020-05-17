@extends('layout.default')
@section('title', '重置密码')
@section('content')
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
            <h5>重置密码</h5>
            </div>
            <div class="card-body">
                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        <label for="email">邮箱</label>
                        <input type="text" name="email" value="{{ $email ?? old('email') }}" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : ''}}">
                        <span class="form-text{{ $errors->has('email') ? ' invalid-feedback' : ''}}">
                            {{ $errors->first('email') }}
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="password">新密码</label>
                        <input type="password" name="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : ''}}">
                        <span class="form-text{{ $errors->has('password') ? ' invalid-feedback' : ''}}">
                            {{ $errors->first('password') }}
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">确认密码</label>
                        <input type="password" name="password_confirmation" id="password_confirm" class="form-control{{ $errors->has('password') ? ' is-invalid' : ''}}">
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-primary">重置密码</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
