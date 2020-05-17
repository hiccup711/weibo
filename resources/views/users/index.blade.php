@extends('layout.default')
@section('title', $title)
@section('content')
    <div class="col-md-8 offset-md-2">
        <h2 class="text-center mb-4">{{ $title }}</h2>
        @if(count($users) > 0)
            <ul class="list-group list-group-flush">
                @if(Request()->route()->getName() == 'users.index')
                    @foreach($users as $user)
                        @include('shared._user_item')
                    @endforeach
                @else
                    @foreach($users as $user)
                        @include('shared._follow_item')
                    @endforeach
                @endif
            </ul>
        @endif
        <div class="mt-4">
            {!! $users->render() !!}
        </div>
    </div>
@stop
