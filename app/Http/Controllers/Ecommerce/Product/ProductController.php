<?php

namespace App\Http\Controllers\Ecommerce\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){

    }
    public function show(Product $product){
        $this->addToViewRecent($product->id);

    }
    private function addToViewRecent($id){
        //Agregar cookie
        $coockie = 'product-view-recents'; //Nombre de cookie
        $minutesOfLifeCookie = 10080; // 1 Semana
        $productViewRecents = [];
        if(isset($_COOKIE[$coockie])):
            $productViewRecents = json_decode($_COOKIE[$coockie]);
            unset($_COOKIE[$coockie]);
            setcookie($coockie, "", time() - 1 );
            if(!in_array($id, $productViewRecents)):
                $productViewRecents[] = $id;
            endif;
        else:
            $productViewRecents[] = $id;
        endif;
        setcookie($coockie, json_encode($productViewRecents), time() + ($minutesOfLifeCookie * 60), '/');
    }
}
