<?php

namespace App\Http\Livewire\Admin\Video;

use App\Models\ModuleWeb;
use App\Models\Video;
use Exception;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['render'];

    public $module;

    public function render(){
        if(Cache::has('videos')):
            $videos = Cache::get('videos');
        else:
            $videos = Video::with('moduleWeb')->orderBy('order')->get();
            Cache::put('videos', $videos);
        endif;
        if($this->module):
            $videos = $videos->where('module_web_id', $this->module);
        endif;
        $modulesWeb = ModuleWeb::orderBy('id')->cursor();
        return view('livewire.admin.video.index', compact('videos', 'modulesWeb'));
    }
    public function destroy(Video $video){
        try{
            $video->delete();
            Cache::forget('videos');
            $this->emit('alert', 'success', 'Eliminación con éxito');
        }catch(Exception $e){
            $this->emit('alert', 'error', 'Ocurrio un error en la eliminación: '.$e->getMessage());
        }
    }
}
