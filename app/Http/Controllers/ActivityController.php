<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ActivityController extends Controller
{
    	public $pusher;
    	public $user;

        public function __construct()
        {


        }

        /**
         * Serve the example activities view
         */
        public function getIndex()
        {
        	$this->pusher = App::make('pusher');
        	$this->user = \Session::get('user');

        	// dd(\Session::get('user'),$this->user);
            // If there is no user, redirect to GitHub login
            
            if(!isset($this->user->id))
            {
                return redirect('auth/github?redirect=/activities');
            }

            // TODO: provide some useful text
            $activity = [
                'text' => $this->user->getNickname().' has visited the page',
                'username' => $this->user->getNickname(),
                'avatar' => $this->user->getAvatar(),
                'id' => str_random(),
                //'id' => 1,//status-update-liked事件
            ];

            // TODO: trigger event
            $this->pusher->trigger('activities', 'user-visit', $activity);


            return view('activities');
        }

        /**
         * A new status update has been posted
         * @param Request $request
         */
        public function postStatusUpdate(Request $request)
        {
        	$this->pusher = App::make('pusher');
        	$this->user = \Session::get('user');

            $statusText = e($request->input('status_text'));

            // TODO: provide some useful text
            $activity = [
                'text' => $statusText,
                'username' => $this->user->getNickname(),
                'avatar' => $this->user->getAvatar(),
                'id' => str_random()
            ];

            // TODO: trigger event
            $this->pusher->trigger('activities', 'new-status-update', $activity);
        }

        /**
         * Like an exiting activity
         * @param $id The ID of the activity that has been liked
         */
        public function postLike($id)
        {
        	$this->pusher = App::make('pusher');
        	$this->user = \Session::get('user');

            // TODO: trigger event
            $activity = [
                // Other properties...

                'text' => '...',
                'username' => $this->user->getNickname(),
                'avatar' => $this->user->getAvatar(),
                'id' => $id,
                'likedActivityId' => $id,
            ];

            // TODO: trigger event
            $this->pusher->trigger('activities', 'status-update-liked', $activity);
        }
}
