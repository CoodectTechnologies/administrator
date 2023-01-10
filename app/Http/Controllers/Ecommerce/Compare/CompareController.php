<?php

namespace App\Http\Controllers\Ecommerce\Compare;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompareController extends Controller
{
    public function index(){
        return view('ecommerce.compare.index');
    }
    public static function store(Product $product){
        if(!Self::existInCompare($product->id)):
            Cart::instance('compare')->add([
                'id' => $product->id,
                'name' => $product->name,
                'qty' => 1,
                'price' => $product->getPriceFinal()
            ])->associate(Product::class);
            Self::saveSession();
            session()->flash('alert', $product->name.' '.__('added'));
            session()->flash('alert-type', 'success');
        endif;
    }
    public static function delete($rowId){
        Cart::instance('compare')->remove($rowId);
        Self::saveSession();
        session()->flash('alert', __('Article was successfully removed'));
        session()->flash('alert-type', 'success');
    }
    private function existInCompare($productId){
        $existInCompare = false;
        $cartItem = Cart::instance('compare')->search(function ($cartItem) use($productId) {
            return $cartItem->id === $productId;
        });
        if($cartItem->isNotEmpty()):
            $existInCompare = true;
        endif;
        return $existInCompare;
    }
    private function saveSession(){
        if(Auth::check()):
            Cart::instance('compare')->store(Auth::id());
        endif;
    }
}
