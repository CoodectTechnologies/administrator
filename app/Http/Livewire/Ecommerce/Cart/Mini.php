<?php

namespace App\Http\Livewire\Ecommerce\Cart;

use App\Http\Controllers\Ecommerce\Cart\CartController;
use App\Models\Product;
use Livewire\Component;

class Mini extends Component
{
    public $product;

    public function mount(Product $product){
        $this->product = $product;
    }
    public function render(){
        return view('livewire.ecommerce.cart.mini');
    }
    public function store(){
        CartController::store($this->product, 1, $this->product->getPriceFinal());
        $this->emitTo('ecommerce.layouts.cart', 'render');
    }
}
