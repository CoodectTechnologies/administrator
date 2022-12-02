<?php

namespace App\Http\Livewire\Admin\Setting\City;

use App\Models\City;
use App\Models\Country;
use Livewire\Component;

class Form extends Component
{
    public $city;
    public $method;

    public function mount(City $city, $method){
        $this->city = $city;
        $this->method = $method;
    }
    protected function rules(){
        return [
            'city.state_id' => 'required|exists:states,id',
            'city.name' => 'required|unique:cities,name,'.$this->city->id,
        ];
    }
    public function render(){
        $countries = Country::orderBy('id', 'desc')->cursor();
        return view('livewire.admin.setting.city.form', compact('countries'));
    }
    public function store(){
        $this->validate();
        $this->city->save();
        $this->emit('alert', 'success', 'Estado agregado con éxito');
        $this->emit('render');
        $this->city = new City();
    }
    public function update(){
        $this->validate();
        $this->city->update();
        $this->emit('alert', 'success', 'Estado actualizado con éxito');
        $this->emit('render');
    }
}
