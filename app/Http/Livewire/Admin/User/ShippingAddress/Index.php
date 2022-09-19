<?php

namespace App\Http\Livewire\Admin\User\ShippingAddress;

use App\Models\ShippingAddress;
use App\Models\User;
use Exception;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['render'];

    public $user;

    public function mount(User $user){
        $this->user = $user;
    }
    public function render(){
        $shippingAddresses = $this->user->shippingAddresses()->with(['orders', 'state.country'])->orderBy('id', 'desc')->cursor();
        return view('livewire.admin.user.shipping-address.index', compact('shippingAddresses'));
    }
    public function destroy(ShippingAddress $shippingAddress){
        try{
            if(!count($shippingAddress->orders)){
                $shippingAddress->delete();
                $this->emit('alert', 'success', 'Eliminación con éxito');
            }else{
                $this->emit('alert', 'warning', 'No puedes eliminar esta dirección por estar relacionada a una orden.');
            }           
        }catch(Exception $e){
            $this->emit('alert', 'error', 'Ocurrio un error en la eliminación: '.$e->getMessage());
        }
    }
}
