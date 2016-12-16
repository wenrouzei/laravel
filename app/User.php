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
        // 'name', 'email', 'github_id', 'avatar', 'password',//github ��������¼����
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
        return $this->hasMany('App\ChatMessage');//��chat_messages���й����ֶ�user_id, ������hasXXX
    }

    public function chatMessage(){
        return $this->hasOne('App\ChatMessage');//��chat_messages���й����ֶ�user_id, ������hasXXX
    }
}
