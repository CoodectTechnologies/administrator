<?php

namespace App\Http\Livewire\Admin\Setting\AccessPayment;

use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use Livewire\Component;

class Form extends Component
{
    public $method;
    //PayPal
    public $paypalClientId;
    //Mercado pago
    public $mercadoPagoKey;
    public $mercadoPagoToken;

    protected function rules(){
        return [
            'paypalClientId' => 'nullable',
            'mercadoPagoKey' => 'nullable',
            'mercadoPagoToken' => 'nullable'
        ];
    }
    public function mount($method){
        $this->method = $method;
        $this->paypalClientId = config('services.paypal.client_id');
        $this->mercadoPagoKey = config('services.mercadopago.key');
        $this->mercadoPagoToken = config('services.mercadopago.token');
    }
    public function render(){
        return view('livewire.admin.setting.access-payment.form');
    }
    public function update(){
        $this->validate();
        try{
            //PayPal
            DotenvEditor::setKey('PAYPAL_CLIENT_ID', $this->paypalClientId)->save();
            //Mercado pago
            DotenvEditor::setKey('MERCADOPAGO_PUBLIC_KEY', $this->mercadoPagoKey)->save();
            DotenvEditor::setKey('MERCADOPAGO_ACCESS_TOKEN', $this->mercadoPagoToken)->save();
            DotenvEditor::deleteBackups();
            if (file_exists(App::getCachedConfigPath())):
                Artisan::call("config:cache");
            endif;
            $this->emit('alert', 'success', 'Accesos actualizados con éxito');
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
        $this->emit('render');
    }
}
