<?php

namespace App\Http\Livewire\Admin\Setting\Country;

use App\Models\Country;
use Livewire\Component;

class Form extends Component
{
    public $country;
    public $method;
    
    public function mount(Country $country, $method){
        $this->country = $country;
        $this->method = $method;
    }
    protected function rules(){
        return [
            'country.name' => 'required|unique:countries,name,'.$this->country->id,
            'country.status' => 'required'
        ];
    }
    public function render(){
        return view('livewire.admin.setting.country.form');
    }
    public function store(){
        $this->validate();
        $this->country->save();
        $this->emit('alert', 'success', 'País agregado con éxito');
        $this->emit('render');
        $this->country = new Country();
    }
    public function update(){
        $this->validate();
        $this->country->update();
        $this->emit('alert', 'success', 'País actualizado con éxito');
        $this->emit('render');
    }
}
