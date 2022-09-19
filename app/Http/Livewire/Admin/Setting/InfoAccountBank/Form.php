<?php

namespace App\Http\Livewire\Admin\Setting\InfoAccountBank;

use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use Livewire\Component;

class Form extends Component
{
    public $method;
    public $paymentBank;
    public $paymentAccountBank;
    public $paymentTarget;
    public $paymentName;

    protected function rules(){
        return [
            'paymentAccountBank' => 'required',
            'paymentTarget' => 'required',
            'paymentBank' => 'required',
            'paymentName' => 'required',
        ];
    }
    public function mount($method){
        $this->method = $method;
        $this->paymentAccountBank = config('payment.account_bank');
        $this->paymentTarget = config('payment.target');
        $this->paymentBank = config('payment.bank');
        $this->paymentName = config('payment.name');
    }
    public function render(){
        return view('livewire.admin.setting.info-account-bank.form');
    }
    public function update(){
        $this->validate();
        try{
            DotenvEditor::setKey('PAYMENT_BANK', $this->paymentBank)->save();
            DotenvEditor::setKey('PAYMENT_ACCOUNT_BANK', $this->paymentAccountBank)->save();
            DotenvEditor::setKey('PAYMENT_TARGET', $this->paymentTarget)->save();
            DotenvEditor::setKey('PAYMENT_NAME', $this->paymentName)->save();
            DotenvEditor::deleteBackups();
            if (file_exists(App::getCachedConfigPath())):
                Artisan::call("config:cache");
            endif;
            $this->emit('alert', 'success', 'Información actualizada con éxito');
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
        $this->emit('render'); 
    }
}
