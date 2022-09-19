<?php

namespace App\Http\Livewire\Admin\Catalog\Product\Color;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Exception;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['render'];
    
    public $product;
    
    public function mount(Product $product){
        $this->product = $product;
    }
    public function render(){
        $colors = $this->product->productColors()->get();
        return view('livewire.admin.catalog.product.color.index', compact('colors'));
    }
    public function destroy(ProductColor $color){
        try{
            $color->delete();
            $this->emit('alert', 'success', 'Eliminación con éxito');
        }catch(Exception $e){
            $this->emit('alert', 'error', 'Ocurrio un error en la eliminación: '.$e->getMessage());
        }
    }
}
