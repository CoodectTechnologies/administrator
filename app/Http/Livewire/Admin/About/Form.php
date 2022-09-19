<?php

namespace App\Http\Livewire\Admin\About;

use App\Models\About;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Form extends Component
{    
    public $about;
    public $method;

    protected function rules(){
        return [
            'about.mission' => 'required',
            'about.vision' => 'required',
            'about.values' => 'required',
        ];
    }
    public function mount(About $about, $method){
        $this->about = $about;
        $this->method = $method; 
    }
    public function render(){
        return view('livewire.admin.about.form');
    }
    public function store(){
        $this->validate();
        $this->about->save();
        $this->about = new About();
        Cache::forget('about');
        $this->emit('alert', 'success', 'Información agregada con éxito');
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->about->update();
        Cache::forget('about');
        $this->emit('alert', 'success', 'Información actualizada con éxito');
        $this->emit('render');
    }
}
