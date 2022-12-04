<?php

namespace App\Http\Livewire\Admin\Catalog\Product\Product;

use App\Models\Image;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\ProductGender;
use App\Models\ShippingClass;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    protected $listeners = ['render'];

    public $product;
    public $method;
    public $submodule;
    public $imageTmp, $imagesTmp = [], $imagesTmpInputId;
    public $catalogCategoryArray = [];
    public $priceCurrenciesArray = [];

    public function rules(){
        return [
            'product.product_gender_id' => 'nullable',
            'product.product_brand_id' => 'nullable',
            'product.shipping_class_id' => 'nullable',
            'product.name' => 'required',
            'product.detail' => 'required',
            'product.description' => 'nullable',
            'product.sku' => 'nullable',
            'product.quantity' => 'nullable|numeric',
            'product.featured' => 'nullable',
            'product.status' => 'required',
            'product.iframe_url' => 'nullable',
            'product.weight' => 'nullable',
            'product.height' => 'nullable',
            'product.width' => 'nullable',
            'product.length' => 'nullable',
            'product.meta_title' => 'nullable',
            'product.meta_description' => 'nullable',
            'product.meta_keywords' => 'nullable',
            'priceCurrenciesArray' => 'required|array|min:1'
        ];
    }
    public function mount(Product $product, $method, Request $request){
        $this->product = $product;
        $this->method = $method;
        $this->submodule = $request->submodule ?? null;
        $this->catalogCategoryArray = $this->product->productCategories()->pluck('product_category_id')->toArray();
        $this->product->status = $this->product->id ? $this->product->status : 'Publicado';
        $this->loadPrices();
        $this->loadRandomImagesTmpInputId();
    }
    public function render(){
        $currencies = Cache::get('currencies') ?? [];
        $categories = ProductCategory::with(['allChildrens' => function($query){
            $query->orderBy('name', 'asc');
        }])->whereNull('parent_id')->orderBy('name', 'asc')->cursor();
        $brands = ProductBrand::orderBy('id', 'desc')->cursor();
        $genders = ProductGender::orderBy('id', 'desc')->cursor();
        $shippingClasses = ShippingClass::orderBy('id', 'desc')->cursor();
        $productImages = $this->product->images()->orderBy('id', 'desc')->get();
        $comments = $this->comments();
        $lineChartModel = $this->graphViews();
        return view('livewire.admin.catalog.product.product.form', compact('currencies', 'categories', 'brands', 'genders', 'shippingClasses', 'productImages', 'comments', 'lineChartModel'));
    }
    public function hydrate(){
        $this->emit('renderJs');
    }
    public function store(){
        $this->validate();
        $this->validateNull();
        $this->product->user_id = Auth::id();
        $this->product->save();
        $this->save();
        $this->product = new Product();
        session()->flash('alert', 'Producto agregado con éxito');
        session()->flash('alert-type', 'success');
        Redirect::route('admin.catalog.product.index');
    }
    public function update(){
        $this->validate();
        $this->validateNull();
        $this->product->update();
        $this->save();
        $this->emit('alert', 'success', 'Actualización con éxito');
        $this->emit('render');
    }
    public function removeImageTemp($key){
        if(array_splice($this->imagesTmp, $key, 1)):
            $this->emit('alert', 'success', 'Imagen eliminada con éxito');
        endif;
    }
    public function removeImageMain(){
        if($this->product->image):
            if(Storage::exists($this->product->image->url)):
                Storage::delete($this->product->image->url);
            endif;
            $this->product->image()->delete();
            $this->product->image = null;
        endif;
        $this->reset('imageTmp');
        $this->emit('alert', 'success', 'Imagen eliminada con éxito');
    }
    public function removeImage(Image $image){
        try{
            $image->delete();
            $this->emit('alert', 'success', 'Imagen eliminada con éxito');
        }catch(Exception $e){
            $this->emit('alert', 'warning', $e->getMessage());
        }
    }
    private function save(){
        $this->savePrice();
        $this->saveImage();
        $this->saveImages();
        $this->saveCategories();
        $this->loadRandomImagesTmpInputId();
        $this->reset('imagesTmp');
    }
    private function savePrice(){
        $priceArrayToSync = [];
        foreach($this->priceCurrenciesArray as $key => $priceCurrencyArray):
            if(!isset($priceCurrencyArray['price']) || !$priceCurrencyArray['price']):
                $this->product->currencies()->detach($key);
            else:
                $priceArrayToSync[$key] = $priceCurrencyArray;
            endif;
        endforeach;
        if($priceArrayToSync):
            $this->product->currencies()->sync($priceArrayToSync);
        endif;
    }
    private function saveImage(){
        if($this->imageTmp):
            $url = $this->imageTmp->store('public/catalog/product');
            imageManager($url, 800, $this->product);
        endif;
    }
    private function saveImages(){
        if($this->imagesTmp):
            foreach ($this->imagesTmp as $imgTmp):
                $url = $imgTmp->store('public/catalog/product/gallery');
                imagesManager($url, 1920, $this->product);
            endforeach;
        endif;
    }
    private function saveCategories(){
        $this->product->productCategories()->sync($this->catalogCategoryArray);
    }
    private function graphViews(){
        $lineChartModel = [];
        if($this->product->id):
            $views = $this->product->views()->select(
                DB::raw('DATE_FORMAT(viewed_at, "%m-%Y") AS month2'),
                DB::raw('DATE_FORMAT(viewed_at, "%b-%Y") AS month'),
                DB::raw('COUNT(id) AS views')
            )
            ->whereYear('viewed_at', date('Y'))
            ->orderBy('month2')
            ->groupBy('month', 'month2')
            ->get();
            $lineChartModel =  new LineChartModel();
            $lineChartModel = $lineChartModel->setTitle('Vistas del '.date('Y'));
            foreach($views as $view):
                $lineChartModel = $lineChartModel->addPoint($view->month, $view->views);
            endforeach;
        endif;
        return $lineChartModel;
    }
    private function comments(){
        return $this->product->comments()->orderBy('id', 'desc')->cursor();
    }
    private function loadRandomImagesTmpInputId(){
        $this->imagesTmpInputId = rand(1, 1000).'-'.$this->product->id;
    }
    private function loadPrices(){
        if(count($this->product->currencies)):
            $this->priceCurrenciesArray = [];
            foreach($this->product->currencies as $currency):
                $this->priceCurrenciesArray[$currency->id] = [
                    'price' => $currency->pivot->price,
                ];
            endforeach;
        endif;
    }
    private function validateNull(){
        if($this->product->quantity == ''):
            $this->product->quantity = null;
        endif;
        if($this->product->weight == ''):
            $this->product->weight = null;
        endif;
        if($this->product->height == ''):
            $this->product->height = null;
        endif;
        if($this->product->width == ''):
            $this->product->width = null;
        endif;
        if($this->product->length == ''):
            $this->product->length = null;
        endif;
        if($this->product->product_gender_id == ''):
            $this->product->product_gender_id = null;
        endif;
        if($this->product->product_brand_id == ''):
            $this->product->product_brand_id = null;
        endif;
        if($this->product->shipping_class_id == ''):
            $this->product->shipping_class_id = null;
        endif;
    }
}
