<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        // 'name', 'email', 'github_id', 'avatar', 'password',//github 第三方登录测试
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function chatMessages(){
        return $this->hasMany('App\ChatMessage');//在chat_messages表有关联字段user_id, 所以用hasXXX
    }

    public function chatMessage(){
        return $this->hasOne('App\ChatMessage');//在chat_messages表有关联字段user_id, 所以用hasXXX
    }
}
