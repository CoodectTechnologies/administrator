<?php

namespace App\Http\Livewire\Admin\Team;

use App\Models\Team;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;
    
    public $person;
    public $method;
    public $imageTmp;
    //Tools
    public $order;

    protected function rules(){
        return [
            'person.order' => 'required',
            'person.name' => 'required',
            'person.biography' => 'required',
            'person.position' => 'nullable',
            'person.facebook' => 'nullable',
            'person.twitter' => 'nullable',
            'person.linkedin' => 'nullable',
            'person.instagram' => 'nullable',
            'person.whatsapp' => 'nullable',
            'imageTmp' =>  $this->person->image ? 'image|nullable' : 'image|required',
        ];
    }
    public function mount(Team $person, $method){
        $this->person = $person;
        $this->method = $method; 
        $this->order = $person->order;
    }
    public function render(){
        $this->loadLastOrder();
        return view('livewire.admin.team.form');
    }
    public function store(){
        $this->validate();
        $this->reOrder();
        $this->person->save();
        $this->saveImage();
        $this->person = new Team();
        $this->reset('imageTmp');
        $this->emit('alert', 'success', 'Persona agregada con éxito');
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->reOrder();
        $this->person->update();
        $this->saveImage();
        $this->emit('alert', 'success', 'Actualización con éxito');
        $this->emit('render');
    }
    public function saveImage(){
        if($this->imageTmp):
            $url = $this->imageTmp->store('public/team');
            imageManager($url, 300, $this->person);
        endif;
    }
    public function removeImage(){
        if($this->person->image):
            if(Storage::exists($this->person->image->url)):
                Storage::delete($this->person->image->url);
            endif;
            $this->person->image()->delete();
            $this->person->image = null;
        endif;
        $this->reset('imageTmp');
        $this->emit('alert', 'success', 'Imagen eliminada con éxito');
    }
    private function reOrder(){
        if($this->order != $this->person->order):
            $teamToOrder = Team::where('order', '>=', $this->person->order)->cursor();
            foreach($teamToOrder as $personToOrder):
                $personToOrder->order = $personToOrder->order + 1;
                $personToOrder->update();
            endforeach;
        endif;
    }
    private function loadLastOrder(){
        if(!$this->person->order):
            $lastOrder = Team::latest('order')->first();
            if($lastOrder):
                $this->person->order = ($lastOrder->order + 1);
            else:
                $this->person->order = 1;
            endif;
        endif;
    }
}
