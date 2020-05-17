<a href="{{ route('followings', $user) }}" class="col-md-4">
    <strong>{{ count($user->followings) }}</strong>
    关注
</a>
<a href="{{ route('followers', $user) }}" class="col-md-4">
    <strong>{{ count($user->followers) }}</strong>
    粉丝
</a>
<a href="" class="col-md-4">
    <strong>{{ count($user->statuses) }}</strong>
    微博
</a>
