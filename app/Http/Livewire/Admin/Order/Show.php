<?php

namespace App\Http\Livewire\Admin\Order;

use App\Http\Controllers\Web\Checkout\CheckoutController;
use App\Mail\Admin\Order\ChangePaymentStatus;
use App\Mail\Admin\Order\ChangeStatus;
use App\Models\Order;
use Exception;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Show extends Component
{
    public $order;
    public $paymentStatus;
    public $status;

    protected function rules(){
        return [
            'order.payment_status' => 'required',
            'order.status' => 'required',
        ];
    }    
    public function mount(Order $order){
        $this->order = $order;
        $this->paymentStatus = $order->payment_status;
        $this->status = $order->status;
        $this->order->load(['products', 'shippingAddress.state.country', 'orderInvoice.shippingAddress.state.country']);
    }
    public function render(){
        return view('livewire.admin.order.show');
    }
    public function sendEmail(){
        CheckoutController::sendEmail($this->order);
    }
    public function update(){
        $this->validate();
        try{
            if($this->order->status != $this->status):
                Mail::to($this->order->shippingAddress->email)->send(new ChangeStatus($this->order));
            endif;
            if($this->order->payment_status != $this->paymentStatus):
                Mail::to($this->order->shippingAddress->email)->send(new ChangePaymentStatus($this->order));
            endif;
            $this->emit('alert', 'success', 'Información actualizada con éxito');
        }catch(Exception $e){
            $this->emit('alert', 'success', 'No se envío el correo de notificación: '.$e->getMessage());
        }
        $this->order->update();
    }
}
