<?php

namespace App\Http\Livewire\Admin\Setting\ShippingZone;

use App\Models\Country;
use App\Models\ShippingClass;
use App\Models\ShippingZone;
use App\Models\State;
use Livewire\Component;

class Form extends Component
{
    public $shippingZone;
    public $method;
    public $countryId;
    public $shippingZoneStatesArray = [];
    public $shippingZonesClassArray = [];

    public function mount(ShippingZone $shippingZone, $method){
        $this->shippingZone = $shippingZone;
        $this->shippingZone->load(['states', 'shippingClasses']);
        $this->method = $method;
        $this->shippingZoneStatesArray = $this->shippingZone->states->pluck('id')->toArray();
        $this->countryId = $this->shippingZone->country_id ?? null;
        $this->loadShippingZoneClasses();
    }
    protected function rules(){
        return [
            'shippingZoneStatesArray' => 'required|array|min:1|exists:states,id',
            'shippingZone.country_id' => 'required|exists:countries,id',
            'shippingZone.name' => 'required|unique:shipping_zones,name,'.$this->shippingZone->id,
            'shippingZone.price' => 'required|numeric',
            'shippingZone.free_shipping_over_to' => 'nullable|numeric',
            'shippingZone.zip_codes' => 'nullable',
        ];
    }
    public function render(){
        $countries = Country::where('status', true)->cursor();
        $states = $this->getStates();
        $shippingClasses = ShippingClass::query()->orderBy('id', 'desc')->cursor();
        return view('livewire.admin.setting.shipping-zone.form', compact('countries', 'states', 'shippingClasses'));
    }
    public function hydrate(){
        $this->emit('renderJs');
    }
    public function store(){
        $this->validate();
        $this->saveCountry();
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
        $this->saveCountry();
        $this->shippingZone->update();
        $this->saveStates();
        $this->saveShippingClass();
        $this->emit('alert', 'success', 'Zona de envío actualizada con éxito');
        $this->emit('render');
    }
    public function updatingCountryId(){
        $this->shippingZoneStatesArray = [];
    }
    private function getStates(){
        $states = [];
        if($this->countryId):
            $states = State::query()->orderBy('name')->where('country_id', $this->countryId)->cursor();
        endif;
        return $states;
    }
    private function saveCountry(){
        if($this->countryId):
            $this->shippingZone->country_id = $this->countryId;
        endif;
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
