<?php

namespace App\Http\Livewire\Admin\Service;

use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $method;
    public $service;
    public $imageTmp;
    //Tools
    public $order;

    protected $listeners = ['render'];

    public function mount(Service $service, $method){
        $this->service = $service;
        $this->method = $method; 
        $this->order = $service->order;
    }
    protected function rules(){
        return [
            'service.name' => 'required|unique:services,name,'.$this->service->id,
            'service.fragment' => 'required',
            'service.body' => 'required',
            'service.order' => 'required',
            'service.category' => 'nullable',
            'service.meta_title' => 'nullable',
            'service.meta_description' => 'nullable',
            'service.meta_keywords' => 'nullable',
            'imageTmp' => $this->service->image ? 'image|nullable' : 'image|required',
        ];
    }
    public function render(){
        $this->loadLastOrder();
        return view('livewire.admin.service.form');
    }
    public function store(){
        $this->validate();
        $this->reOrder();
        $this->service->save();
        $this->saveImage();
        session()->flash('alert', 'Servicio agregado con éxito');
        session()->flash('alert-type', 'success');
        return redirect()->route('admin.service.show', $this->service);
    }
    public function update(){
        $this->validate();
        $this->reOrder();
        $this->service->update();
        $this->saveImage();
        session()->flash('alert', 'Servicio actualizado con éxito');
        session()->flash('alert-type', 'success');
        return redirect()->route('admin.service.show', $this->service);
    }
    public function saveImage(){
        if($this->imageTmp):
            $url = $this->imageTmp->store('public/service');
            imageManager($url, 900, $this->service);
        endif;
    }
    public function removeImage(){
        if($this->service->image):
            if(Storage::exists($this->service->image->url)):
                Storage::delete($this->service->image->url);
            endif;
            $this->service->image()->delete();
            $this->service->image = null;
        endif;
        $this->reset('imageTmp');
        $this->emit('alert', 'success', 'Imagen eliminada con éxito');
    }
    private function reOrder(){
        if($this->order != $this->service->order):
            $servicesToOrder = Service::where('order', '>=', $this->service->order)->cursor();
            foreach($servicesToOrder as $bannerToOrder):
                $bannerToOrder->order = $bannerToOrder->order + 1;
                $bannerToOrder->update();
            endforeach;
        endif;
    }
    private function loadLastOrder(){
        if(!$this->service->order):
            $lastOrder = Service::latest('order')->first();
            if($lastOrder):
                $this->service->order = ($lastOrder->order + 1);
            else:
                $this->service->order = 1;
            endif;
        endif;
    }
}
