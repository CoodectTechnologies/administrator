<?php

namespace App\Http\Livewire\Admin\Promotion;

use App\Models\Promotion;
use Exception;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['render'];

    public function render(){
        $promotions = Promotion::query()->with(['products', 'currencies'])->orderBy('id', 'desc')->cursor();
        return view('livewire.admin.promotion.index', compact('promotions'));
    }
    public function destroy(Promotion $promotion){
        try{
            $promotion->delete();
            $this->emit('alert', 'success', 'Eliminación con éxito');
        }catch(Exception $e){
            $this->emit('alert', 'error', 'Ocurrio un error en la eliminación: '.$e->getMessage());
        }
    }
}
