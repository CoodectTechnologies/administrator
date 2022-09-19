<?php

namespace App\Http\Livewire\Admin\Video;

use App\Models\ModuleWeb;
use App\Models\Video;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Form extends Component
{    
    public $video;
    public $method;

    protected function rules(){
        return [
            'video.module_web_id' => 'required|exists:module_webs,id',
            'video.order' => 'required',
            'video.iframe_url' => 'required|url',
            'video.name' => 'nullable',
            'video.body' => 'nullable',
        ];
    }
    public function mount(Video $video, $method){
        $this->video = $video;
        $this->method = $method; 
    }
    public function render(){
        $this->loadLastOrder();
        $modulesWeb = ModuleWeb::orderBy('id')->cursor();
        return view('livewire.admin.video.form', compact('modulesWeb'));
    }
    public function store(){
        $this->validate();
        $this->reOrder();
        $this->video->save();
        $this->video = new Video();
        Cache::forget('videos');
        $this->emit('alert', 'success', 'Video agregado con éxito');
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->reOrder();
        $this->video->update();
        Cache::forget('videos');
        $this->emit('alert', 'success', 'Video actualizado con éxito');
        $this->emit('render');
    }
    public function reOrder(){
        $videosToOrder = Video::where('order', '>=', $this->video->order)->cursor();
        foreach($videosToOrder as $videoToOrder):
            $videoToOrder->order = $videoToOrder->order + 1;
            $videoToOrder->update();
        endforeach;
    }
    public function loadLastOrder(){
        if(!$this->video->order):
            $lastOrder = Video::latest('order')->first();
            if($lastOrder):
                $this->video->order = ($lastOrder->order + 1);
            else:
                $this->video->order = 1;
            endif;
        endif;
    }
}
