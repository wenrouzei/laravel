<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ChatController extends Controller
{
    public $pusher;
    public $user;
    public $users;
    public $chatChannel;

    const DEFAULT_CHAT_CHANNEL = 'chat';

    public function __construct()
    {

    }

    public function getIndex()
    {
        \Session::pull('users');
    	$users = \Session::get('users');
    	if(!$users){
    		$users = array(
    			'username' => '向晖挫男'.rand(1,1000).'号',
    			'avatar' => 'avatar.png'
    		);
    		\Session::put('users',$users);
    		// dd(\Session::get('users'));
    	}
    	$this->pusher = App::make('pusher');
    	// $this->user = \Session::get('user');
    	$this->chatChannel = self::DEFAULT_CHAT_CHANNEL;

        // if(!$this->user)
        // {
        //     return redirect('auth/github?redirect=/chat');//用户没有认证过则跳转github页面认证下
        // }

        return view('chat', ['chatChannel' => $this->chatChannel]);
    }


    //在chat视图中处理AJAX请求，频道是chat，事件是new-message，把头像、昵称、消息内容、消息时间一起发送
    public function postMessage(Request $request)
    {
    	$this->pusher = App::make('pusher');
    	// $this->user = \Session::get('user');
    	$this->users = \Session::get('users');
    	$this->chatChannel = self::DEFAULT_CHAT_CHANNEL;
// dd($this->users);
        $message = [
            'text' => e($request->input('chat_text')),
            // 'username' => $this->user->getNickname(),
            'username' => $this->users['username'],
            // 'avatar' => $this->user->getAvatar(),
            'avatar' => $this->users['avatar'],
            'timestamp' => (time()*1000)
        ];
        $this->pusher->trigger($this->chatChannel, 'new-message', $message);
    }
}
