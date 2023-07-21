<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderPlaced
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $mainOrder;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\MainOrder  $mainOrder
     * @return void
     */
    public function __construct($mainOrder)
    {
        $this->mainOrder = $mainOrder;
    }
}
