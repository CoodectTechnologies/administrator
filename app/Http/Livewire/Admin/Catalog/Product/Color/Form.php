<?php

namespace App\Http\Livewire\Admin\Catalog\Product\Color;

use App\Models\Image;
use App\Models\Product;
use App\Models\ProductColor;
use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $method;
    public $product;
    public $color;
    public $sizeArray = [];
    public $imagesTmp = [], $imagesTmpInputId;

    protected function rules(){
        return [
            'color.name' => 'required',
            'color.hexadecimal' => 'required',
        ];
    }
    public function mount(Product $product, ProductColor $color, $method){
        $this->product = $product;
        $this->color = $color;
        $this->method = $method;
        $this->sizeArray = $this->color->productSizes()->pluck('product_size_id')->toArray();
        $this->loadRandomImagesTmpInputId();
    }
    public function render(){
        $sizes = $this->product->productSizes()->get();
        $productImages = $this->color->images()->orderBy('id', 'desc')->get();
        return view('livewire.admin.catalog.product.color.form', compact('sizes', 'productImages'));
    }
    public function hydrate(){
        $this->emit('renderJs');
    }
    public function store(){
        $this->validate();
        $this->color = $this->product->productColors()->create($this->color->toArray());
        $this->saveSizes();
        $this->saveImages();
        $this->color = new ProductColor;
        $this->emit('alert', 'success', 'Color agregado al producto con éxito');
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->color->update();
        $this->saveSizes();
        $this->saveImages();
        $this->emit('alert', 'success', 'Color del producto actualizado con éxito');
        $this->emit('render');
    }
    public function saveSizes(){
        $this->color->productSizes()->sync($this->sizeArray);
    }
    private function saveImages(){
        if($this->imagesTmp):
            foreach ($this->imagesTmp as $imgTmp):
                $url = $imgTmp->store('public/catalog/product/gallery');
                imagesManager($url, 800, $this->color);
            endforeach;
        endif;
    }
    public function removeImageTemp($key){
        if(array_splice($this->imagesTmp, $key, 1)):
            $this->emit('alert', 'success', 'Imagen eliminada con éxito');
        endif;
    }
    public function removeImage(Image $image){
        try{
            $image->delete();
            $this->emit('alert', 'success', 'Imagen eliminada con éxito');
        }catch(Exception $e){
            $this->emit('alert', 'warning', $e->getMessage());
        }
    }
    private function loadRandomImagesTmpInputId(){
        $this->imagesTmpInputId = rand(1, 1000).'-'.$this->product->id;
    }
}
