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
        $this->currency->active = $this->currency->active ?? true;
    }
    protected function rules(){
        return [
            'currency.name' => 'required|unique:currencies,name,'.$this->currency->id,
            'currency.code' => 'required|unique:currencies,code,'.$this->currency->id,
            'currency.symbol' => 'required',
            'currency.default' => 'nullable',
            'currency.active' => 'required'
        ];
    }
    public function render(){
        return view('livewire.admin.setting.currency.form');
    }
    public function store(){
        $this->validate();
        $this->validateDefault();
        $this->currency->save();
        $this->saveCache();
        $this->emit('alert', 'success', 'Creación con éxito');
        $this->emit('render');
        $this->currency = new Currency();
    }
    public function update(){
        $this->validate();

        $this->validateDefault();
        $this->currency->update();
        $this->saveCache();
        $this->emit('alert', 'success', 'Actualización con éxito');
        $this->emit('render');
    }
    private function validateDefault(){
        if(!Currency::count()){
            $this->currency->default = true;
        }else{
            if($this->currency->default){
                Currency::query()->update(['default' => false]);
            }
        }
    }
    private function saveCache(){
        Cache::forget('currencies');
        $currencies = Currency::where('active', true)->orderBy('id')->get();
        Cache::put('currencies', $currencies);
    }
}
