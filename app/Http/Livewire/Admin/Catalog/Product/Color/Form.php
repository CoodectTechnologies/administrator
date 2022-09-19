<?php

namespace App\Http\Livewire\Admin\Catalog\Product\Color;

use App\Models\Product;
use App\Models\ProductColor;
use Livewire\Component;

class Form extends Component
{   
    public $method;
    public $product;
    public $color;
    public $sizeArray = [];

    protected function rules(){
        return [
            'color.name' => 'required',
        ];
    }
    public function mount(Product $product, ProductColor $color, $method){
        $this->product = $product;
        $this->color = $color;
        $this->method = $method;   
        $this->sizeArray = $this->color->productSizes()->pluck('product_size_id')->toArray();
    }
    public function render(){
        $sizes = $this->product->productSizes()->get();
        return view('livewire.admin.catalog.product.color.form', compact('sizes'));
    }
    public function hydrate(){
        $this->emit('renderJs');
    }
    public function store(){
        $this->validate();
        $this->color = $this->product->productColors()->create($this->color->toArray());
        $this->saveSizes();
        $this->color = new ProductColor;
        $this->emit('alert', 'success', 'Color agregado al producto con éxito');
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->color->update();
        $this->saveSizes();
        $this->emit('alert', 'success', 'Color del producto actualizado con éxito');
        $this->emit('render');
    }
    public function saveSizes(){
        $this->color->productSizes()->sync($this->sizeArray);
    }
}
