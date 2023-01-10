<?php

namespace App\Http\Controllers\Ecommerce\Wishlist;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Ecommerce\Cart\CartController;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index(){
        return view('ecommerce.wishlist.index');
    }
    public static function store(Product $product){
        if(!Self::existInWishlist($product->id)):
            Cart::instance('wishlist')->add(
                $product->id,
                $product->name,
                1,
                $product->getPriceFinal()
            )->associate(Product::class);
            Self::saveSession();
            session()->flash('alert', $product->name.' '.__('it was added correctly'));
            session()->flash('alert-type', 'success');
        endif;
    }
    public static function storeInCart(Product $product){
        CartController::store($product, 1, $product->getPriceFinal());
    }
    public static function delete($rowId){
        Cart::instance('wishlist')->remove($rowId);
        Self::saveSession();
        session()->flash('alert', __('Article was successfully removed'));
        session()->flash('alert-type', 'success');
    }
    private function existInWishlist($productId){
        $existInWishlist = false;
        $cartItem = Cart::instance('wishlist')->search(function ($cartItem) use($productId) {
            return $cartItem->id === $productId;
        });
        if($cartItem->isNotEmpty()):
            $existInWishlist = true;
        endif;
        return $existInWishlist;
    }
    private function saveSession(){
        if(Auth::check()):
            Cart::instance('wishlist')->store(Auth::id());
        endif;
    }
}
