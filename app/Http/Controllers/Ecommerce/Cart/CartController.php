<?php

namespace App\Http\Controllers\Ecommerce\Cart;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function index(){
        return view('ecommerce.cart.index');
    }
    public static function store(Product $product, $qty, $price, $options = []){
        if(($product->productSizes()->count() || $product->productColors()->count()) && !count($options)):
            session()->flash('alert', __('This product has variations, please select the options indicated'));
            session()->flash('alert-type', 'warning');
            return Redirect::route('ecommerce.product.show', $product);
        endif;
        if(Self::validateStock($product, $qty)):
            Cart::instance('default')->add([
                'id' => $product->id,
                'name' => $product->name,
                'qty' => $qty,
                'price' => $price,
                'options' => $options
            ])->associate(Product::class);
            Self::saveSession();
            session()->flash('alert', $product->name.' '.__('added'));
            session()->flash('alert-type', 'success');
        endif;
    }
    public static function update($product, $qty, $rowId){
        if(Self::validateStock($product, $qty)):
            Cart::instance('default')->update($rowId, $qty);
            Self::saveSession();
            session()->flash('alert', __('The article was successfully updated'));
            session()->flash('alert-type', 'success');
        endif;
    }
    public static function destroy($rowId){
        Cart::instance('default')->remove($rowId);
        Self::saveSession();
        session()->flash('alert', __('Article was successfully removed'));
        session()->flash('alert-type', 'success');
    }
    private function validateStock($product, $qty = 1){
        $validateStock = true;
        //Si el producto no tiene cantidad infinita, iniciamos validación
        if($product->quantity !== null):
            //Obtenemos el mismo producto del carrito en caso de que existe en el carrito
            $cartItem = Cart::instance('default')->search(function ($cartItem) use($product) {
                return $cartItem->id === $product->id;
            });
            //Si existe en el carrito entonces obtenemos cuantos ya existen en el carrito
            if($cartItem->isNotEmpty()):
                $qty += $cartItem->first()->qty;
            endif;
            $validateStock = ($product->quantity >= $qty);
        endif;
        return $validateStock;
    }
    private function saveSession(){
        if(Auth::check()):
            Cart::instance('default')->store(Auth::id());
        endif;
    }
}
