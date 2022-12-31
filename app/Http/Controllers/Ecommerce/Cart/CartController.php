<?php

namespace App\Http\Controllers\Ecommerce\Cart;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        return view('ecommerce.cart.index');
    }
    public static function store(Product $product, $qty, $price, $options = []){
        if(Self::validateStock($product, $qty)):
            Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'qty' => $qty,
                'price' => $price,
                'options' => $options
            ])->associate(Product::class);
            session()->flash('alert', $product->name.' se agrego correctamente!');
            session()->flash('alert-type', 'success');
        endif;
    }
    public static function update($product, $qty, $rowId){
        if(Self::validateStock($product, $qty)):
            Cart::update($rowId, $qty);
            session()->flash('alert','¡El artículo se actualizó correctamente!');
            session()->flash('alert-type', 'success');
        endif;
    }
    public static function destroy($rowId){
        Cart::remove($rowId);
        session()->flash('alert','¡El artículo se eliminó correctamente!');
        session()->flash('alert-type', 'success');
    }
    private function validateStock($product, $qty = 1){
        $validateStock = true;
        //Si el producto no tiene cantidad infinita, iniciamos validación
        if($product->quantity !== null):
            //Obtenemos el mismo producto del carrito en caso de que existe en el carrito
            $cartItem = Cart::search(function ($cartItem) use($product) {
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
}
