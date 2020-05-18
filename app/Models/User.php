<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function gravatar($size = 100)
    {
        $hash = md5(strtolower(trim($this->email)));
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }
//    在用户创建的方法时，向 activation_token 字段添加一个 10位随机字符串作为邮箱验证token
    public static function boot()
    {
        parent::boot();
        User::creating(function($user){
            $user->activation_token = Str::random(10);
        });
    }
    public function statuses()
    {
        return $this->hasMany(Status::class);
    }
//    首页媒体流
    public function feed()
    {
        $user_ids = $this->followings->pluck('id')->toArray();
        array_push($user_ids, $this->id);
        Status::whereIn('user_id', $user_ids)->orderBy('created_at','desc');
//        避免N+1查询，使用了 user 方法关联了所有status的user_id数据
        return Status::whereIn('user_id', $user_ids)->with('user')->orderBy('created_at','desc');
    }
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }
    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }
    public function follow($user_ids)
    {
        if(!is_array($user_ids))
        {
            $user_ids = compact('user_ids');
        }
        $this->followings()->sync($user_ids, false);
    }
    public function unfollow($user_ids)
    {
        if(!is_array($user_ids))
        {
            $user_ids = compact('user_ids');
        }
        $this->followings()->detach($user_ids);
    }
    public function isFollowing($user)
    {
        return $this->followings->contains($user);
    }
}
