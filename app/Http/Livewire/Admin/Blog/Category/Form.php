<?php

namespace App\Http\Livewire\Admin\Blog\Category;

use App\Models\BlogCategory;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Form extends Component
{
    public $method;
    public $blogCategory;

    public function mount(BlogCategory $blogCategory, $method){
        $this->blogCategory = $blogCategory;
        $this->method = $method;    
    }
    protected function rules(){
        return [
            'blogCategory.name' => 'required',
        ];
    }
    public function render(){
        return view('livewire.admin.blog.category.form');
    }
    public function store(){
        $this->validate();
        $this->blogCategory->save();
        $this->blogCategory = new BlogCategory();
        Cache::forget('blogCategories');
        $this->emit('alert', 'success', 'Categoría agregada con éxito');
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->blogCategory->update();
        Cache::forget('blogCategories');
        $this->emit('alert', 'success', 'Categoría actualizada con éxito');
        $this->emit('render');
    }
}
