<?php

namespace App\Http\Livewire\Ecommerce\Wishlist;

use App\Http\Controllers\Ecommerce\Wishlist\WishlistController;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class Mini extends Component
{
    public $product;

    public function mount(Product $product){
        $this->product = $product;
    }
    public function render(){
        return view('livewire.ecommerce.wishlist.mini');
    }
    public function store(){
        WishlistController::store($this->product);
        $this->emitTo('ecommerce.layouts.wishlist', 'render');
    }
}
