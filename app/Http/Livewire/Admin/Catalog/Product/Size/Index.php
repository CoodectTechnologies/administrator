<?php

namespace App\Http\Livewire\Admin\Catalog\Product\Size;

use App\Models\Product;
use App\Models\ProductSize;
use Exception;
use Livewire\Component;

class Index extends Component
{
    public $product;

    protected $listeners = ['render'];

    public function mount(Product $product){
        $this->product = $product;
    }
    public function render(){
        $sizes = $this->product->productSizes()->get();
        return view('livewire.admin.catalog.product.size.index', compact('sizes'));
    }
    public function destroy(ProductSize $size){
        try{
            $size->delete();
            $this->emit('alert', 'success', 'Eliminación con éxito');
        }catch(Exception $e){
            $this->emit('alert', 'error', 'Ocurrio un error en la eliminación: '.$e->getMessage());
        }
    }
}
