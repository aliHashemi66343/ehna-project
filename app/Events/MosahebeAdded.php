<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
//use Illuminate\Broadcasting\Channel;
//use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
//use Illuminate\Queue\SerializesModels;

class MosahebeAdded implements ShouldBroadcast
{
    use SerializesModels;

    public $mosahebe;

    public function __construct($mosahebe)
    {
        $this->mosahebe = $mosahebe;
    }

    public function broadcastOn()
    {
        return new Channel('events');
    }
}
