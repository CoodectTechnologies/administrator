<?php

namespace App\Http\Livewire\Admin\Gallery;

use App\Models\Gallery;
use App\Models\ModuleWeb;
use Exception;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['render'];

    public $module;

    public function render(){
        if(Cache::has('galleries')):
            $galleries = Cache::get('galleries');
        else:
            $galleries = Gallery::with(['images', 'moduleWeb'])->orderBy('id', 'desc')->get();
            Cache::put('galleries', $galleries);
        endif;
        if($this->module):
            $galleries = $galleries->where('module_web_id', $this->module);
        endif;
        $modulesWeb = ModuleWeb::orderBy('id')->cursor();
        return view('livewire.admin.gallery.index', compact('galleries', 'modulesWeb'));
    }
    public function destroy(Gallery $gallery){
        try{
            foreach($gallery->images()->get() as $image):
                $image->delete();
            endforeach;
            $gallery->delete();
            Cache::forget('galleries');
            $this->emit('alert', 'success', 'Eliminación con éxito');
        }catch(Exception $e){
            $this->emit('alert', 'error', 'Ocurrio un error en la eliminación: '.$e->getMessage());
        }
    }
}
