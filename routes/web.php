<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'admin','namespace' => 'Admin'],function ($router)
{
    $router->get('login', 'LoginController@showLoginForm')->name('admin.login');
    $router->post('login', 'LoginController@login');
    $router->post('logout', 'LoginController@logout');

    $router->get('dash', 'DashboardController@index');
});

//github 第三方登录测试
Route::get('auth/github', 'Auth\AuthController@redirectToProvider');
Route::get('auth/github/callback', 'Auth\AuthController@handleProviderCallback');


//实时广播数据测试pusher通过可以使用 依赖 composer require pusher/pusher-php-server ？
Route::get('/broadcast', function () {
    event(new App\Events\ShippingStatusUpdated(1));
    return 'This is a Laravel Broadcaster Test!';
});


//实时数据测试pusher通过可以使用 依赖vinkla/pusher扩展
Route::get('/bridge/{msg?}', function($msg) {
    $pusher = \Illuminate\Support\Facades\App::make('pusher');

    $pusher->trigger( 'test-channel',
                      'test-event', 
                      ['text' => $msg??'I Love China!!!']
                    );
    return 'This is a Laravel Pusher Bridge Test!';
});

//实时数据测试pusher通过可以使用 依赖vinkla/pusher扩展
Route::get('notifications', 'NotificationController@getIndex');
Route::post('notifications/postNotify', 'NotificationController@postNotify');

//实时数据测试pusher通过可以使用 依赖vinkla/pusher扩展
Route::get('activities', 'ActivityController@getIndex');
Route::post('activities/postStatusUpdate', 'ActivityController@postStatusUpdate');
Route::post('activities/postLike/{id}', 'ActivityController@postLike');

//实时聊天室测试pusher通过可以使用  依赖vinkla/pusher扩展
Route::get('chat', 'ChatController@getIndex');
Route::post('chat/postMessage', 'ChatController@postMessage');


Route::get('redis/{msg}', function($msg){
    Illuminate\Support\Facades\Redis::set('abc',$msg);
    return Illuminate\Support\Facades\Redis::get('abc');
});

//实时数据测试通过可以用 依赖 nodejs express socket.io redis
Route::get('writemessage', 'SocketController@writemessage');
Route::any('sendmessage', 'SocketController@sendMessage');

//实时数据测试通过可以用 依赖 nodejs socket.io ioredis  / pusher/pusher-php-server laravel-echo
Route::get('test', 'TestController@index');
Route::get('test/fire', 'TestController@fire');


Route::get('has-or-belong', function() {
    // return App\User::find(1)->chatMessage;// hasOne 一对一          user表在chat_messagesibao有关联字段
    // return App\User::find(1)->chatMessages;//hasMany 一对多         user表在chat_messagesibao有关联字段
    return App\ChatMessage::find(1)->user;//belongTo 多属于一            chat_messagesibao表在user表没关联字段、但user表在chat_messages表有关联字段，从属关系
});