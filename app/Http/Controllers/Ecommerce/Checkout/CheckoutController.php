<?php

namespace App\Http\Controllers\Ecommerce\Checkout;

use App\Http\Controllers\Controller;
use App\Mail\Web\Order\newOrder;
use App\Models\Order;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class CheckoutController extends Controller
{
    public function index(){
        if(!Cart::count()):
            return Redirect::route('ecommerce.product.index');
        endif;
        return view('ecommerce.checkout.index');
    }
    public function payment(Order $order){
        if(in_array($order->payment_status, ['Aprobado', 'Rechazado'])):
            return Redirect::route('web.checkout.complete', $order);
        endif;
        $order->load(['products', 'shippingAddress.state.country']);
        return view('ecommerce.checkout.payment', compact('order'));
    }
    public function paymentMercadoPago(Order $order, Request $request){
        if($paymentId = $request->payment_id):
            $response = Http::get('https://api.mercadopago.com/v1/payments/'.$paymentId.'?access_token='.config('services.mercadopago.token'));
            $response = json_decode($response);
            if($response->status == 'approved'):
                $order->payment_status = 'Aprobado';
            endif;
            $order->payment_id = $paymentId;
            $order->payment_method = 'Mercadopago';
            $order->payment_data = json_encode($response);
            $order->save();
            Cart::destroy();
            Self::decrementStock($order);
            return Redirect::route('ecommerce.checkout.complete', $order);
        else:
            return Redirect::back();
        endif;
    }
    public function complete(Order $order, Request $request){
        return view('ecommerce.checkout.complete', compact('order'));
    }
    public static function decrementStock($order){
        $order->load('products');
        if($order->payment_status == 'Aprobado'):
            foreach ($order->products as $product):
                if($product->quantity !== null): // null == Sin limite de stock
                    $product->update(['quantity' => ($product->quantity - $product->pivot->quantity)]);
                endif;
            endforeach;
        endif;
    }
    public static function sendEmail($order){
        try{
            Mail::to($order->shippingAddress->email)
            ->bcc(config('contact.emails_with_cc'))
            ->send(new newOrder($order));
            $order->send_email = true;
            $order->update();
        }catch(Exception $e){
            $order->send_email = false;
            $order->send_email_error = $e->getMessage();
            $order->update();
        }
    }
}
