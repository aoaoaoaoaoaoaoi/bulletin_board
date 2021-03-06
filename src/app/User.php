<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'profile', 'resource', 'email', 'password'
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

    //リレーション
    public function threadMessages()
    {
        return $this->hasMany('App\ThreadMessage');
    }


    public static function searchUser(Array $userIds, string $userName){
        return self::Ids($userIds)
            ->UserName($userName);
    }

    public function scopeIds($query, Array $userIds){
        if(empty($userId) || count($userIds) < 1){
            return $query;
        }
        return $query->whereIn('id', $userIds);
    }

    public function scopeUserName($query, String $userName){
        if(empty($userName)){
            return $query;
        }
        return $query->where('name', 'LIKE', "%$userName%");
    }
}
