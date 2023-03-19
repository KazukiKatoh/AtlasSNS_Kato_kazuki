<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Auth;
use App\Post;
use App\User;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function following(){
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id')->withTimestamps();
    }
    public function followers(){
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'following_id')->withTimestamps();
    }
    public function isFollowed(User $user){
        return $this->followers->contains($user);
    }
    public function isFollowing(User $user){
        return $this->following->contains($user);
    }
    public function followingCount(){
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id')->count();
    }
    public function followersCount(){
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'following_id')->count();
    }

}
