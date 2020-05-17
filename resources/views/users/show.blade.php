@extends('layout.default')
@section('title', $user->name .'的主页')
@section('content')
    <div class="container">
        <div class="col-md-8 offset-2">
            <section class="user-info">
                @include('shared._user_info')
            </section>
            @can('follow', $user)
                <section class="follow text-center mt-3">
                    @include('shared._follow')
                </section>
            @endcan
            <section class="stats row mt-3 mb-3">
                @include('shared._stats')
            </section>
            @if(Auth::check() && Auth::user()->id == $user->id)
                <section class="form-status">
                    @include('shared._status_form')
                </section>
            @endif
            <hr>
            <section class="status mt-4">
                @if( count($statuses) > 0 )
                    <ul class="list-unstyled">
                        @foreach( $statuses as $status )
                            @include('statuses._status')
                        @endforeach
                    </ul>
                @else
                    <p class="text-center mt-4">Ta还没有发过微博</p>
                @endif
            </section>
            <div class="mt-4">
                {!! $statuses->render() !!}
            </div>
        </div>
    </div>
@stop
