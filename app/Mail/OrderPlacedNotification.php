<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPlacedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $mainOrder;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mainOrder)
    {
        $this->mainOrder = $mainOrder;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.order_placed');
    }
}
