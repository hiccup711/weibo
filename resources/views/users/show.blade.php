@extends('layout.default')
@section('title', $user->name .'的主页')
@section('content')
    <div class="container">
        <div class="col-md-8 offset-2">
        <section class="user-info">
            @include('shared._user_info')
        </section>
        </div>
    </div>
@stop
