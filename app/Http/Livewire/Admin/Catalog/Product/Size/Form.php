<?php

namespace App\Http\Livewire\Admin\Catalog\Product\Size;

use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Form extends Component
{

    public $product;
    public $size;
    public $method;
    public $colorArray = [];
    public $priceSizeCurrenciesArray = [];

    protected function rules(){
        return [
            'size.name' => 'required',
            'priceSizeCurrenciesArray' => 'required|array|min:1'
        ];
    }
    public function mount(Product $product, ProductSize $size, $method){
        $this->product = $product;
        $this->size = $size;
        $this->method = $method;
        $this->size->price = $this->size->price ?? $this->product->price;
        $this->colorArray = $this->size->productColors()->pluck('product_color_id')->toArray();
        $this->loadPriceSizes();
    }
    public function render(){
        $currencies = Cache::get('currencies') ?? [];
        $colors = $this->product->productColors()->get();
        return view('livewire.admin.catalog.product.size.form', compact('currencies', 'colors'));
    }
    public function hydrate(){
        $this->emit('renderJs');
    }
    public function store(){
        $this->validate();
        $this->size = $this->product->productSizes()->create($this->size->toArray());
        $this->savePrice();
        $this->saveColors();
        $this->size = new ProductSize;
        $this->emit('alert', 'success', 'Medida agregada al producto con éxito');
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->size->update();
        $this->savePrice();
        $this->saveColors();
        $this->emit('alert', 'success', 'Medida del producto actualizada con éxito');
        $this->emit('render');
    }
    private function savePrice(){
        $priceSizesArrayToSync = [];
        foreach($this->priceSizeCurrenciesArray as $key => $priceCurrencyArray):
            if(!isset($priceCurrencyArray['price']) || !$priceCurrencyArray['price']):
                $this->size->currencies()->detach($key);
            else:
                $priceSizesArrayToSync[$key] = $priceCurrencyArray;
            endif;
        endforeach;
        if($priceSizesArrayToSync):
            $this->size->currencies()->sync($priceSizesArrayToSync);
        endif;
    }
    public function saveColors(){
        $this->size->productColors()->sync($this->colorArray);
    }
    private function loadPriceSizes(){
        if(count($this->size->currencies)):
            $this->priceSizeCurrenciesArray = [];
            foreach($this->size->currencies as $currency):
                $this->priceSizeCurrenciesArray[$currency->id] = [
                    'price' => $currency->pivot->price,
                ];
            endforeach;
        endif;
    }
}
