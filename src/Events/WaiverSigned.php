<?php

namespace Tipoff\Waivers\Events;

use Tipoff\Waivers\Models\Signature;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WaiverSigned
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $signature;

    /**
     * Create a new event instance.
     *
     * @param Signature $signature
     */
    public function __construct(Signature $signature)
    {
        $this->signature = $signature;
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
