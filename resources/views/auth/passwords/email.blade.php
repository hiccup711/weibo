@extends('layout.default')
@section('title', '重置密码')
@section('content')
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
            <h5>重置密码</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">邮箱</label>
                        <input type="text" name="email" value="{{ old('email') }}" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : ''}}">
                        <span class="form-text{{ $errors->has('email') ? ' invalid-feedback' : ''}}">
                            {{ $errors->first('email') }}
                        </span>
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-primary">发送密码重置邮件</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
