@extends('layout.default')
@section('title', '编辑资料')
@section('content')
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h5>编辑资料</h5>
            </div>
            <div class="card-body">
                @include('shared._errors')
                <form action="{{ route('users.update', $user) }}" method="POST">
                    @csrf
                    {{ method_field('PATCH') }}
                    <div class="mb-5 text-center">
                        <a href="http://www.gravatar.com/emails">
                            <img src="{{ $user->gravatar(120) }}" alt="{{ $user->name }}" class="gravatar">
                        </a>
                    </div>
                    <div class="form-group">
                        <label for="name">名称</label>
                        <input type="text" name="name" value="{{ $user->name }}" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">邮箱</label>
                        <input type="text" name="email" value="{{ $user->email }}" id="email" class="form-control" readonly>
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
                        <button type="submit" class="btn btn-primary">更新</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
