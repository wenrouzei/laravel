<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    //
    public $fillable = ['user_id', 'message'];

    public function user(){
    	return $this->belongsTo('App\User');//users表在chat_messages表有关联字段user_id, 所以是输入从属关系，用belongsTo
    }
}
