@if(count(session()->all()) > 0)
    @foreach(['success','warning','info','danger'] as $message)
        @if(session()->has($message))
            <div class="alert alert-{{ $message }}">
                {{ session($message) }}
            </div>
        @endif
    @endforeach
@endif
