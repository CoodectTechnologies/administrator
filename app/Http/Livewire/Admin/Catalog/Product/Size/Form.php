<?php

namespace App\Http\Livewire\Admin\Catalog\Product\Size;

use App\Models\Product;
use App\Models\ProductSize;
use Livewire\Component;

class Form extends Component
{
    
    public $product;
    public $size;
    public $method;
    public $colorArray = [];

    protected function rules(){
        return [
            'size.name' => 'required',
            'size.price' => 'nullable|numeric',
        ];
    }
    public function mount(Product $product, ProductSize $size, $method){
        $this->product = $product;
        $this->size = $size;
        $this->method = $method;   
        $this->size->price = $this->size->price ?? $this->product->price;
        $this->colorArray = $this->size->productColors()->pluck('product_color_id')->toArray();
    }
    public function render(){
        $colors = $this->product->productColors()->get();
        return view('livewire.admin.catalog.product.size.form', compact('colors'));
    }
    public function hydrate(){
        $this->emit('renderJs');
    }
    public function store(){
        $this->validate();
        $this->size = $this->product->productSizes()->create($this->size->toArray());
        $this->saveColors();
        $this->size = new ProductSize;
        $this->emit('alert', 'success', 'Medida agregada al producto con éxito');
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->size->update();
        $this->saveColors();
        $this->emit('alert', 'success', 'Medida del producto actualizada con éxito');
        $this->emit('render');
    }
    public function saveColors(){
        $this->size->productColors()->sync($this->colorArray);
    }
}
