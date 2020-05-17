@if(Auth::user()->isFollowing($user))
    <form action="{{ route('unfollow', $user) }}" method="POST">
        @csrf
        {{ method_field("DELETE") }}
        <button type="submit" class="btn btn-outline-primary">取消关注</button>
    </form>
@else
    <form action="{{ route('follow', $user) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">关注</button>
    </form>
@endif
