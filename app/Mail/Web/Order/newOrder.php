<?php

namespace App\Mail\Web\Order;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class newOrder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $order;
    
    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->order->load('products');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Orden: #'.$this->order->number.' recibida')
        ->cc(config('contact.email'))
        ->markdown('web.emails.order.new-order', [
            'order' => $this->order
        ]);
    }
}
