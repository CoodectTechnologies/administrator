<?php

namespace App\Http\Livewire\Ecommerce\Product;

use App\Http\Controllers\Ecommerce\Cart\CartController;
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

    public $colorSelected;
    public $sizeSelected;
    public $priceToString;
    public $quantity = 1;

    protected function rules(){
        return [
            'quantity' => 'required',
        ];
    }
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
            $this->colorSelected = ProductColor::findOrFail($colorId);
            $this->loadGallery($this->colorSelected);
        endif;
    }
    public function loadSize($sizeId = null){
        if(!$sizeId):
            $this->sizes = $this->product->productSizes;
            $this->reset('sizeSelected');
            $this->loadPrice();
        else:
            $this->sizeSelected = ProductSize::findOrFail($sizeId);
            if($this->colorSelected):
                if(!$this->sizeSelected->validateSizeColorSelected($this->colorSelected->id)):
                    $this->reset('colorSelected');
                endif;
            endif;
            $this->loadPrice();
        endif;
    }
    public function loadPrice(){
        if(!$this->sizeSelected):
            $this->priceToString = $this->product->getPriceToString();
            if($pricePromotion = $this->product->getPricePromotion()):
                $this->price = $pricePromotion;
            else:
                $this->price = $this->product->getPrice();
            endif;
        else:
            $this->priceToString = $this->sizeSelected->getPriceToString();
            if($pricePromotion = $this->sizeSelected->getPricePromotion()):
                $this->price = $pricePromotion;
            else:
                $this->price = $this->sizeSelected->getPrice();
            endif;
        endif;
    }
    public function loadGallery($color = null){
        if($color):
            $this->gallery = $color->images()->get();
        else:
            $imageMain = $this->product->image()->get();
            $gallery = $this->product->images()->get();
            $this->gallery = $imageMain->merge($gallery);
        endif;
    }
    public function addCart(){
        $options = [
            'size' => [
                'id' => $this->sizeSelected ? $this->sizeSelected->id : null,
                'name' => $this->sizeSelected ? $this->sizeSelected->name : null,
            ],
            'color' => [
                'id' => $this->colorSelected ? $this->colorSelected->id : null,
                'name' => $this->colorSelected ? $this->colorSelected->name : null,
            ],
            'imageCart' => isset($this->gallery[0]) ? $this->gallery[0]->imagePreview() : $this->product->imagePreview()
        ];
        CartController::store($this->product, $this->quantity, $this->price, $options);
        $this->emitTo('ecommerce.layouts.cart', 'render');
        $this->emit('notifyAddCart');
    }
    public function resetVariation(){
        $this->reset('sizeSelected', 'colorSelected');
    }
}
