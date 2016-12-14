<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class SocketController extends Controller
{
    public function writemessage()
    {
        Session::put('username', '聊天用户'.rand(1,10000));
        $redis = Redis::connection();
        $redis->publish('message', json_encode(['msg'=>'login in','username'=>Session::get('username')]));
        return view('writemessage');
    }

    public function sendMessage(Request $request){
        $username = Session::get('username');
        $redis = Redis::connection();
        $redis->publish('message', json_encode(['msg'=>$request->input('message'),'username'=>$username]));
        // return redirect('writemessage');
    }
}
