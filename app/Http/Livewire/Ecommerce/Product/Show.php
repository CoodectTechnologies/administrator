<?php

namespace App\Http\Livewire\Ecommerce\Product;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Livewire\Component;

class Show extends Component
{
    public $product;
    public $gallery;
    public $colors;
    public $sizes;
    public $price;

    public $colorFilter;
    public $sizeFilter;
    public $priceToString;
    public $quantity = 1;

    public function mount(Product $product){
        $this->product = $product;
        $this->product->load(['images', 'productCategories', 'productSizes', 'productColors']);
        $this->loadGallery();
        $this->loadColor();
        $this->loadSize();
    }
    public function render(){
        $commentCount = $this->product->comments()->where('approved', true)->count();
        return view('livewire.ecommerce.product.show', compact('commentCount'));
    }
    public function hydrate(){
        $this->emit('renderJs');
    }
    public function loadColor($colorId = null){
        if(!$colorId):
            $this->colors = $this->product->productColors;
        else:
            $this->colorFilter = ProductColor::findOrFail($colorId);
            $this->loadGallery($this->colorFilter);
        endif;
    }
    public function loadSize($sizeId = null){
        if(!$sizeId):
            $this->sizes = $this->product->productSizes;
            $this->reset('sizeFilter');
            $this->loadPrice();
        else:
            $this->sizeFilter = ProductSize::findOrFail($sizeId);
            if($this->colorFilter):
                if(!$this->sizeFilter->validateSizeColorSelected($this->colorFilter->id)):
                    $this->reset('colorFilter');
                endif;
            endif;
            $this->loadPrice();
        endif;
    }
    public function loadPrice(){
        if(!$this->sizeFilter):
            $this->priceToString = $this->product->getPriceToString();
            if($this->product->price_promotion):
                $this->price = $this->product->price_promotion;
            else:
                $this->price = $this->product->price;
            endif;
        else:
            $this->priceToString = $this->sizeFilter->getPriceToString();
            $this->price = $this->sizeFilter->price;
        endif;
    }
    public function loadGallery($color = null){
        if($color):
            $this->gallery = $color->images()->get();
        else:
            $this->gallery = $this->product->images()->get();
        endif;
    }
    public function addCart(){
        $size = $this->sizeFilter ? $this->sizeFilter->name : null;
        $color = $this->colorFilter ? $this->colorFilter->name : null;
        $options = ['size' => $size, 'color' => $color];
        // ShoppingCartController::store($this->product, $this->quantity, $this->price, $options);
        // $this->emitTo('web.layouts.shopping-cart', 'renderShoppingCart');
    }
}
