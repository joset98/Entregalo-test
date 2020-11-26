<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RegisterSupply
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $supply;

    public $deliveryRequestId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct( Array $supply, $deliveryRequestId)
    {
        $this->supply = $supply;
        $this->deliveryRequestId = $deliveryRequestId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
