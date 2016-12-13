<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class NotificationController extends Controller
{
    public function getIndex()
    {
    	// var_dump(\Session::get('user'));
        return view('vendor.notifications.notification');
    }

    public function postNotify(Request $request)
    {
        $notifyText = e($request->input('notify_text'));
        $socketId = e($request->input('socketId'));

        // TODO: Get Pusher instance from service container
        $pusher = App::make('pusher');
        // TODO: The notification event data should have a property named 'text'

        // TODO: On the 'notifications' channel trigger a 'new-notification' event
        $pusher->trigger('notifications', 'new-notification', $notifyText, $socketId);
    }
}
