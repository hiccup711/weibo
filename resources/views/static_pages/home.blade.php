@extends('layout.default')
@section('content')
    @if(Auth::check())
        <div class="row">
            <div class="col-md-8">
                <section class="form-status">
                    @include('shared._status_form')
                </section>
                <hr>
                @if(count($feed_items) > 0)
                <section class="statuses">
                    @foreach($feed_items as $status)
                        @include('statuses._status', ['user'=>$status->user])
                    @endforeach
                </section>
                @else
                <p class="mt-4">还没有人发过微博</p>
                @endif
                <div class="mt-4">
                    {!! $feed_items->render() !!}
                </div>
            </div>
            <aside class="col-md-4">
                <section class="user-info">
                    @include('shared._user_info', ['user' => Auth::user()])
                </section>
                <section class="stats row mt-4">
                    @include('shared._stats', ['user' => Auth::user()])
                </section>
            </aside>
        </div>
    @else
        <div class="jumbotron">
            <h1>Hello Laravel</h1>
            <p class="lead">你现在所看到的是 <a href="">Laravel入门教程</a> 的示例项目主页</p>
            <p>一切，将从这里开始</p>
            <a href="{{ route('users.create') }}" class="btn btn-success btn-lg">现在注册</a>
        </div>
    @endif
@stop
