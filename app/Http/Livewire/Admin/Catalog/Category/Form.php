<?php

namespace App\Http\Livewire\Admin\Catalog\Category;

use App\Models\ProductCategory;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{    
    use WithFileUploads;
    
    public $category;
    public $method;
    public $imageTmp;

    protected function rules(){
        return [
            'category.name' => 'required',
            'imageTmp' => 'image|nullable',
        ];
    }
    public function mount(ProductCategory $category, $method){
        $this->category = $category;
        $this->method = $method; 
    }
    public function render(){
        return view('livewire.admin.catalog.category.form');
    }
    public function store(){
        $this->validate();
        $this->category->save();
        $this->saveImage();
        $this->category = new ProductCategory();
        $this->reset('imageTmp');
        $this->emit('alert', 'success', 'Categoría agregado con éxito');
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->category->update();
        $this->saveImage();
        $this->emit('alert', 'success', 'Actualización con éxito');
        $this->emit('render');
    }
    public function saveImage(){
        if($this->imageTmp):
            $url = $this->imageTmp->store('public/catalog/category');
            imageManager($url, 260, $this->category);
        endif;
    }
    public function removeImage(){
        if($this->category->image):
            if(Storage::exists($this->category->image->url)):
                Storage::delete($this->category->image->url);
            endif;
            $this->category->image()->delete();
            $this->category->image = null;
        endif;
        $this->reset('imageTmp');
        $this->emit('alert', 'success', 'Imagen eliminada con éxito');
    }
}
