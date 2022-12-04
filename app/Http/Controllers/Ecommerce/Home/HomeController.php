<?php

namespace App\Http\Controllers\Ecommerce\Home;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class HomeController extends Controller
{
    public function index(){
        $bannersPrimary = Cache::get('banners') ? Cache::get('banners')->where('module_web_id', 10) : [];
        $bannersSecondary = Cache::get('banners') ? Cache::get('banners')->where('module_web_id', 11) : [];
        $productsFeatured = Product::query()->currencySession()->with(['image', 'images', 'comments'])->where('featured', true)->cursor();
        $partners = Cache::get('partners') ?? [];
        $productsViewRecents = $this->productsViewRecents();
        $categoriesFhater = ProductCategory::query()
        ->has('products')
        ->has('allChildrens')
        ->with('products')
        ->with(['allChildrens.products' => function($query){
            $query->take(9);
        }])
        ->whereNull('parent_id')
        ->limit(2)
        ->inRandomOrder()
        ->get();
        return view('ecommerce.home.index', compact('bannersPrimary', 'bannersSecondary', 'productsFeatured', 'partners', 'categoriesFhater', 'productsViewRecents'));
    }
    private function productsViewRecents(){
        //Extraer ids by cookie
        $products = [];
        $coockie = 'product-view-recents'; //Nombre de cookie
        if(isset($_COOKIE[$coockie])):
            $productIds = json_decode($_COOKIE[$coockie]);
            $products = Product::with(['image', 'comments'])->whereIn('id', $productIds)->cursor();
        endif;
        return $products;
    }
}
