<?php

namespace App\Http\Livewire\Admin\Setting\Currency;

use App\Models\Currency;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Form extends Component
{
    public $currency;
    public $method;

    public function mount(Currency $currency, $method){
        $this->currency = $currency;
        $this->method = $method;
    }
    protected function rules(){
        return [
            'currency.name' => 'required|unique:currencies,name,'.$this->currency->id,
            'currency.code' => 'required|unique:currencies,code,'.$this->currency->id,
        ];
    }
    public function render(){
        return view('livewire.admin.setting.currency.form');
    }
    public function store(){
        $this->validate();
        $this->currency->save();
        Cache::forget('currency');
        $this->emit('alert', 'success', 'Creación con éxito');
        $this->emit('render');
        $this->currency = new Currency();
    }
    public function update(){
        $this->validate();
        Cache::forget('currency');
        $this->currency->update();
        $this->emit('alert', 'success', 'Actualización con éxito');
        $this->emit('render');
    }
}
