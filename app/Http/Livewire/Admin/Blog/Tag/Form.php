<?php

namespace App\Http\Livewire\Admin\Blog\Tag;

use App\Models\BlogTag;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Form extends Component
{
    public $method;
    public $blogTag;

    public function mount(BlogTag $blogTag, $method){
        $this->blogTag = $blogTag;
        $this->method = $method;    
    }
    protected function rules(){
        return [
            'blogTag.name' => 'required',
        ];
    }
    public function render(){
        return view('livewire.admin.blog.tag.form');
    }
    public function store(){
        $this->validate();
        $this->blogTag->save();
        $this->blogTag = new BlogTag();
        Cache::forget('blogTags');
        $this->emit('alert', 'success', 'Etiqueta agregada con éxito');
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->blogTag->update();
        Cache::forget('blogTags');
        $this->emit('alert', 'success', 'Etiqueta actualizada con éxito');
        $this->emit('render');
    }
}
