@extends('layout.default')
@section('content')
    <div class="jumbotron">
        <h1>Hello Laravel</h1>
        <p class="lead">你现在所看到的是 <a href="">Laravel入门教程</a> 的示例项目主页</p>
        <p>一切，将从这里开始</p>
        <a href="{{ route('users.create') }}" class="btn btn-success btn-lg">现在注册</a>
    </div>
@stop
