<?php

namespace App\Http\Livewire\Ecommerce\Cart;

use App\Http\Controllers\Ecommerce\Cart\CartController;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class Index extends Component
{
    public function render(){
        $cart = Cart::instance('default')->content();
        $subtotal = Cart::subtotal();
        return view('livewire.ecommerce.cart.index', compact('cart', 'subtotal'));
    }
    public function update($productId, $rowId, $qty){
        $product = Product::findOrFail($productId);
        CartController::update($product, $rowId, $qty);
        $this->emitTo('ecommerce.layouts.cart', 'render');
    }
    public function delete($rowId){
        CartController::destroy($rowId);
        $this->emitTo('ecommerce.layouts.cart', 'render');
    }
    public function deleteCart(){
        Cart::instance('default')->destroy();
        $this->emitTo('ecommerce.layouts.cart', 'render');
    }
}
