<?php

namespace App\Http\Livewire\Ecommerce\Product;

use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Index extends Component
{
    public $perPage = 12;
    protected $paginationTheme = 'bootstrap';

    //Filters
    public $search;
    public $orderByFilter;
    public $categoryFilter;
    public $brandFilter;
    public $minPriceFilter;
    public $maxPriceFilter;

    protected $queryString = [
        'search' => ['except' => ''],
        'orderByFilter' => ['except' => ''],
        'categoryFilter' => ['except' => ''],
        'brandFilter' => ['except' => ''],
        'minPriceFilter' => ['except' => ''],
        'maxPriceFilter' => ['except' => ''],
    ];

    public function mount(Request $request){
        if($request->search):
            $this->search = $request->search;
        endif;
        if($request->orderBy):
            $this->orderByFilter = $request->orderBy;
        endif;
        if($request->category):
            $this->categoryFilter = $request->category;
        endif;
        if($request->brand):
            $this->brandFilter = $request->brand;
        endif;
        if($request->minPrice):
            $this->minPriceFilter = $request->minPrice;
        endif;
        if($request->maxPrice):
            $this->maxPriceFilter = $request->maxPrice;
        endif;
    }
    public function render(){
        $productCategories = ProductCategory::with('products')->cursor();
        $productBrands = ProductBrand::with('products')->cursor();
        $products = Product::with('productCategories')->currencySession()->validateProduct();
        $products = $this->filters($products);
        $products = $products->paginate($this->perPage);
        return view('livewire.ecommerce.product.index', compact('products', 'productCategories', 'productBrands'));
    }
    public function filters($products){
        if($this->search):
            $products = $products->where('name', 'LIKE', "%{$this->search}%")
            ->where('sku', $this->search)
            ->orWhereRelation('productCategories', 'name', 'LIKE', "%{$this->search}%")
            ->orWhereRelation('productBrand', 'name', 'LIKE', "%{$this->search}%");
        endif;
        if($this->categoryFilter):
            $products = $products->whereRelation('productCategories', 'slug', $this->categoryFilter);
        endif;
        if($this->brandFilter):
            $products = $products->whereRelation('productBrand', 'slug', $this->brandFilter);
        endif;
        if($this->orderByFilter):
            switch($this->orderByFilter):
                case 'featured':
                    $products = $products->where('featured', true);
                    break;
                case 'price-low':
                    $products = $products->whereHas('currencies', function($query){
                        $query->orderBy('price');
                    });
                    break;
                case 'price-high':
                    $products = $products->whereHas('currencies', function($query){
                        $query->orderBy('price', 'desc');
                    });
                    break;
            endswitch;
        else:
            $products = $products->orderBy('id', 'desc');
        endif;
        if($this->minPriceFilter):
            $products = $products->whereHas('currencies', function($query){
                $query->where('price', '>=', $this->minPriceFilter);
            });
        endif;
        if($this->maxPriceFilter):
            $products = $products->whereHas('currencies', function($query){
                $query->where('price', '<=', $this->maxPriceFilter);
            });
        endif;
        return $products;
    }
    public function filterPrice($minPrice = null, $maxPrice = null){
        $this->minPriceFilter = $minPrice;
        $this->maxPriceFilter = $maxPrice;
    }
    public function existAnyFilter(){
        $existAnyFilter = false;
        if(
            $this->search ||
            $this->categoryFilter ||
            $this->brandFilter ||
            $this->orderByFilter ||
            $this->minPriceFilter ||
            $this->maxPriceFilter
        ):
            $existAnyFilter = true;
        endif;
        return $existAnyFilter;
    }
    public function clearFilter(){
        $this->reset('search', 'categoryFilter', 'brandFilter', 'orderByFilter', 'minPriceFilter', 'maxPriceFilter');
    }
}
