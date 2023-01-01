<?php

namespace App\Notifications\Order;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreate extends Notification
{
    use Queueable;

    private $order;

    public function __construct(Order $order){
        $this->order = $order;
    }
    public function via($notifiable){
        return ['database'];
    }
    public function toArray($notifiable){
        return [
            'url' => route('admin.order.show', $this->order),
            'icon' => 'fas fa-shopping-bag',
            'type' => 'success',
            'title' => 'Nueva orden '.$this->order->number,
            'body' => 'Estado de pago: '.$this->order->paymentStatusToString()
        ];
    }
}
