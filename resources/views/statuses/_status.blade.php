<li class="media mt-4 mb-4">
    <a href="{{ route('users.show', $user) }}">
        <img src="{{ $user->gravatar(45) }}" alt="{{ $user->name }}" class="mr-3 gravatar">
    </a>
    <div class="media-body">
        <h5>{{ $user->name }} <small>/ {{ $status->created_at->diffForHumans() }}</small></h5>
        {{ $status->content }}
    </div>
    @can('destroy', $status)
    <form action="{{ route('status.destroy', $status) }}" method="POST" class="float-right" onsubmit="return confirm('确定删除该条微博吗？')">
        @csrf
        {{ method_field('DELETE') }}
        <button type="submit" class="btn btn-danger btn-sm">删除</button>
    </form>
    @endcan
</li>
