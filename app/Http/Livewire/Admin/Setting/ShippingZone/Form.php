<?php

namespace App\Http\Livewire\Admin\Setting\ShippingZone;

use App\Models\ShippingClass;
use App\Models\ShippingZone;
use App\Models\State;
use Livewire\Component;

class Form extends Component
{
    public $shippingZone;
    public $method;
    public $shippingZoneStatesArray = [];
    public $shippingZonesClassArray = [];
    
    public function mount(ShippingZone $shippingZone, $method){
        $this->shippingZone = $shippingZone;
        $this->shippingZone->load(['states', 'shippingClasses']);
        $this->method = $method;
        $this->shippingZoneStatesArray = $this->shippingZone->states->pluck('id')->toArray();
        $this->loadShippingZoneClasses();
    }
    protected function rules(){
        return [
            'shippingZone.name' => 'required|unique:shipping_zones,name,'.$this->shippingZone->id,
            'shippingZone.price' => 'required|numeric',
            'shippingZone.free_shipping_over_to' => 'nullable|numeric',
            'shippingZone.zip_codes' => 'nullable',
            'shippingZoneStatesArray' => 'required|exists:states,id',
        ];
    }
    public function render(){
        $states = State::query()->with('country')->orderBy('id')->cursor();
        $shippingClasses = ShippingClass::query()->orderBy('id', 'desc')->cursor();
        return view('livewire.admin.setting.shipping-zone.form', compact('states', 'shippingClasses'));
    }
    public function store(){
        $this->validate();
        $this->shippingZone->save();
        $this->saveStates();
        $this->saveShippingClass();
        $this->emit('alert', 'success', 'Zona de envío agregada con éxito');
        $this->emit('render');
        $this->reset('shippingZoneStatesArray', 'shippingZonesClassArray');
        $this->shippingZone = new ShippingZone();
    }
    public function update(){
        $this->validate();
        $this->shippingZone->update();
        $this->saveStates();
        $this->saveShippingClass();
        $this->emit('alert', 'success', 'Zona de envío actualizada con éxito');
        $this->emit('render');
    }
    public function saveStates(){
        $this->shippingZone->states()->sync($this->shippingZoneStatesArray);
    }
    public function saveShippingClass(){
        $shippingZoneClassArrayToSync = [];
        foreach($this->shippingZonesClassArray as $key => $shippingZoneClassArray):
            if(!isset($shippingZoneClassArray['price']) || !$shippingZoneClassArray['price']):
                $this->shippingZone->shippingClasses()->detach($key);
            else:
                $shippingZoneClassArrayToSync[$key] = $shippingZoneClassArray;
            endif;
        endforeach;
        if($shippingZoneClassArrayToSync):
            $this->shippingZone->shippingClasses()->sync($shippingZoneClassArrayToSync);
        endif;
    }
    public function loadShippingZoneClasses(){
        if(count($this->shippingZone->shippingClasses)):
            $this->shippingZonesClassArray = [];
            foreach($this->shippingZone->shippingClasses as $shippingClass):
                $this->shippingZonesClassArray[$shippingClass->id] = [
                    'price' => $shippingClass->pivot->price,
                    'multiply_quantity' => $shippingClass->pivot->multiply_quantity
                ];
            endforeach;
        endif;
    }
}
