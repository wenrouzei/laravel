<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PusherEvent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $text, $id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($text, $id)
    {
        $this->text = $text;
        $this->id   = $id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('laravel-channel-name');
    }
}
