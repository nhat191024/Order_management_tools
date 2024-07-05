<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderCreate implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id;
    public $name;
    public $note;
    public $quantity;
    public $table;
    public $kitchen;
    /**
     * Create a new event instance.
     */
    public function __construct($billDetailId, $name, $note, $quantity, $table, $kitchen)
    {
        $this->id = $billDetailId;
        $this->name = $name;
        $this->note = $note;
        $this->quantity = $quantity;
        $this->table = $table;
        $this->kitchen = $kitchen;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('orders'.$this->kitchen),
        ];
    }
}
