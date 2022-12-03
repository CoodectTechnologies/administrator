<?php

namespace App\Http\Livewire\Admin\Setting\Currency;

use App\Models\Currency;
use Exception;
use Livewire\Component;

class Index extends Component
{
    public $search;
    protected $queryString = ['search' => ['except' => '']];
    protected $listeners = ['render'];

    public function render(){
        $currencies = Currency::orderBy('id');
        if($this->search):
            $currencies = $currencies->where('code', 'LIKE', "%{$this->search}%")->orWhere('name', 'LIKE', "%{$this->search}%");
        endif;
        $currencies = $currencies->cursor();
        return view('livewire.admin.setting.currency.index', compact('currencies'));
    }
    public function destroy(Currency $currency){
        try{
            if(Currency::count() == 1):
                $this->emit('alert', 'warning', 'No puedes eliminar todas las monedas, deberá de existir minimo 1');
                return;
            endif;
            if($currency->default):
                $this->emit('alert', 'warning', 'No puedes eliminar esta moneda, primero deberás de asignar a otra moneda la opcion por default');
                return;
            endif;
            $currency->delete();
            $this->emit('alert', 'success', 'Eliminación con éxito');
        }catch(Exception $e){
            $this->emit('alert', 'error', 'Ocurrio un error en la eliminación: '.$e->getMessage());
        }
    }
}
