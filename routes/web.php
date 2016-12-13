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


Route::get('/broadcast', function () {
    event(new App\Events\PusherEvent('Great Wall is great ', '1'));
    return 'This is a Laravel Broadcaster Test!';
});


//测试pusher通过可以使用
Route::get('/bridge/{msg?}', function($msg) {
    $pusher = \Illuminate\Support\Facades\App::make('pusher');

    $pusher->trigger( 'test-channel',
                      'test-event', 
                      ['text' => $msg??'I Love China!!!']
                    );
    return 'This is a Laravel Pusher Bridge Test!';
});

//测试pusher通过可以使用
Route::get('notifications', 'NotificationController@getIndex');
Route::post('notifications/postNotify', 'NotificationController@postNotify');

//测试pusher通过可以使用
Route::get('activities', 'ActivityController@getIndex');
Route::post('activities/postStatusUpdate', 'ActivityController@postStatusUpdate');
Route::post('activities/postLike/{id}', 'ActivityController@postLike');

//聊天室测试pusher通过可以使用
Route::get('chat', 'ChatController@getIndex');
Route::post('chat/postMessage', 'ChatController@postMessage');