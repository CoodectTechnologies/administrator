<?php

namespace App\Http\Livewire\Admin\Blog\Category;

use App\Models\BlogCategory;
use Exception;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['render'];

    public function render(){
        if(Cache::has('blogCategories')):
            $blogCategories = Cache::get('blogCategories');
        else:
            $blogCategories = BlogCategory::with('blogPosts')->orderBy('id', 'desc')->get();
            Cache::put('blogCategories', $blogCategories);
        endif;
        return view('livewire.admin.blog.category.index', compact('blogCategories'));
    }
    public function destroy(BlogCategory $blogTag){
        try{
            $blogTag->delete();
            Cache::forget('blogCategories');
            $this->emit('alert', 'success', 'Eliminación con éxito');
        }catch(Exception $e){
            $this->emit('alert', 'error', 'Ocurrio un error en la eliminación: '.$e->getMessage());
        }
    }
}
