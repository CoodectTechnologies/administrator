<?php

namespace App\Http\Livewire\Admin\Banner;

use App\Models\Banner;
use App\Models\ModuleWeb;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;
    
    public $banner;
    public $method;
    public $imageTmp, $videoTmp;
    //Tools
    public $order;

    protected function rules(){
        return [
            'banner.module_web_id' => 'required|exists:module_webs,id',
            'banner.order' => 'required',
            'banner.type' => 'required',
            'banner.title' => 'nullable',
            'banner.subtitle' => 'nullable',
            'banner.btn_url' => 'nullable|url',
            'banner.btn_text' => 'nullable',
        ];
    }
    public function mount(Banner $banner, $method){
        $this->banner = $banner;
        $this->method = $method; 
        $this->order = $banner->order;
    }
    public function render(){
        $this->loadLastOrder();
        $modulesWeb = ModuleWeb::orderBy('id')->cursor();
        return view('livewire.admin.banner.form', compact('modulesWeb'));
    }
    public function store(){
        $this->validate();
        $this->validateType();
        $this->reOrder();
        $this->saveVideo();
        $this->banner->save();
        $this->saveImage();
        $this->banner = new Banner();
        Cache::forget('banners');
        $this->reset('imageTmp');
        $this->emit('alert', 'success', 'Banner agregado con éxito');
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->validateType();
        $this->reOrder();
        $this->saveVideo();
        $this->banner->update();
        $this->saveImage();
        Cache::forget('banners');
        $this->emit('alert', 'success', 'Banner actualizado con éxito');
        $this->emit('render');
    }
    private function validateType(){
        if($this->banner->type == 'Imagen'):
            if(!$this->banner->image):
                $this->validate(['imageTmp' => 'required']);
            endif;
        endif;
        if($this->banner->type == 'Video'):
            if(!$this->banner->video):
                $this->validate(['videoTmp' => 'required']);
            endif;
        endif;
    }
    public function saveImage(){
        if($this->imageTmp):
            $url = $this->imageTmp->store('public/banner/'.strtolower($this->banner->module));
            imageManager($url, 1920, $this->banner);
        endif;
    }
    public function saveVideo(){
        if($this->videoTmp):
            $url = $this->videoTmp->store('public/banner/'.strtolower($this->banner->module));
            if($this->banner->video):
                if(Storage::exists($this->banner->video)):
                    Storage::delete($this->banner->video);
                endif;
            endif;
            $this->banner->video = $url;
        endif;
    }
    public function removeImage(){
        if($this->banner->image):
            if(Storage::exists($this->banner->image->url)):
                Storage::delete($this->banner->image->url);
            endif;
            $this->banner->image()->delete();
            $this->banner->image = null;
        endif;
        $this->reset('imageTmp');
        $this->emit('alert', 'success', 'Imagen eliminada con éxito');
    }
    public function removeVideo(){
        if($this->banner->video):
            if(Storage::exists($this->banner->video)):
                Storage::delete($this->banner->video);
            endif;
            $this->banner->video = null;
        endif;
        $this->reset('videoTmp');
        $this->emit('alert', 'success', 'Video eliminado con éxito');
    }
    private function reOrder(){
        if($this->order != $this->banner->order):
            $bannersToOrder = Banner::where('order', '>=', $this->banner->order)->cursor();
            foreach($bannersToOrder as $bannerToOrder):
                $bannerToOrder->order = $bannerToOrder->order + 1;
                $bannerToOrder->update();
            endforeach;
        endif;
    }
    private function loadLastOrder(){
        if(!$this->banner->order):
            $lastOrder = Banner::latest('order')->first();
            if($lastOrder):
                $this->banner->order = ($lastOrder->order + 1);
            else:
                $this->banner->order = 1;
            endif;
        endif;
    }
}
