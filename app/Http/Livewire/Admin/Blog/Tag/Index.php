<?php

namespace App\Http\Livewire\Admin\Blog\Tag;

use App\Models\BlogTag;
use Exception;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['render'];

    public function render(){
        if(Cache::has('blogTags')):
            $blogTags = Cache::get('blogTags');
        else:
            $blogTags = BlogTag::with('blogPosts')->orderBy('id', 'desc')->get();
            Cache::put('blogTags', $blogTags);
        endif;
        return view('livewire.admin.blog.tag.index', compact('blogTags'));
    }
    public function destroy(BlogTag $blogTag){
        try{
            $blogTag->delete();
            Cache::forget('blogTags');
            $this->emit('alert', 'success', 'Eliminación con éxito');
        }catch(Exception $e){
            $this->emit('alert', 'error', 'Ocurrio un error en la eliminación: '.$e->getMessage());
        }
    }
}
