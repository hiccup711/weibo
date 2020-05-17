<li class="list-group-item">
    <img src="{{ $user->gravatar(32) }}" alt="{{ $user->name }}" class="gravatar mr-3">
    <a href="{{ route('users.show', $user) }}">{{ $user->name }}</a>
{{--    @can('destroy', $user)--}}
{{--    <form action="{{ route('users.destroy', $user) }}" method="POST" class="float-right" onsubmit="return confirm('确定删除该用户吗？')">--}}
{{--        @csrf--}}
{{--        {{ method_field("DELETE") }}--}}
{{--        <button type="submit" class="btn btn-danger btn-sm">删除</button>--}}
{{--    </form>--}}
{{--    @endcan--}}
</li>
