<?php

namespace App\Http\Livewire\Admin\Promotion;

use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use Livewire\Component;
use App\Models\Promotion;
use Illuminate\Support\Facades\Redirect;

class Form extends Component
{
    public $promotion;
    public $method;
    public $promotionablesArray = [];
    public $search;
    protected $queryString = ['search' => ['except' => '']];

    protected function rules(){
        return [
            'promotion.name' => 'required',
            'promotion.percentage' => 'required|min:1',
            'promotion.date_start' => 'required|date',
            'promotion.date_end' => 'required|date',
            'promotion.type' => 'required',
            'promotion.conditional' => 'nullable',
            'promotion.active' => 'required',
            'promotion.include_to_variant' => 'required',
        ];
    }
    public function mount(Promotion $promotion, $method){
        $this->promotion = $promotion;
        $this->method = $method;
        $this->loadModels();
        $this->loadPromotionables();
    }
    public function render(){
        $models = $this->loadModels();
        return view('livewire.admin.promotion.form', compact('models'));
    }
    public function store(){
        $this->validate();
        $this->validateCustom();
        $this->promotion->save();
        $this->savePromotionables();
        $this->emit('alert', 'success', 'Promoción agregada con éxito');
        $this->emit('render');
        Redirect::route('admin.promotion.index');
    }
    public function update(){
        $this->validate();
        $this->validateCustom();
        $this->promotion->update();
        $this->savePromotionables();
        $this->emit('alert', 'success', 'Promoción actualizada con éxito');
        $this->emit('render');
        Redirect::route('admin.promotion.index');
    }
    private function validateCustom(){
        if($this->promotion->type != 'Todos'):
            $this->validate([
                'promotion.conditional' => 'required',
                'promotionablesArray' => 'required|array|min:1'
            ]);
        endif;
    }
    private function savePromotionables(){
        if(count($this->promotionablesArray)):
            switch($this->promotion->type):
                case 'Categoría':
                    $this->promotion->productCategories()->sync($this->promotionablesArray);
                    break;
                case 'Marca':
                    $this->promotion->productBrands()->sync($this->promotionablesArray);
                    break;
                case 'Producto':
                    $this->promotion->products()->sync($this->promotionablesArray);
                    break;
            endswitch;
        endif;
    }
    private function loadModels(){
        $models = [];
        if ($this->promotion->type && $this->promotion->type != 'Todos'):
            switch($this->promotion->type):
                case 'Producto':
                    $models = Product::orderBy('name');
                    $models = $this->applyFilter($models);
                    $models = $models->cursor();
                    break;
                case 'Categoría':
                    $models = ProductCategory::orderBy('name');
                    $models = $this->applyFilter($models);
                    $models = $models->cursor();
                    break;
                case 'Marca':
                    $models = ProductBrand::orderBy('name');
                    $models = $this->applyFilter($models);
                    $models = $models->cursor();
                    break;
            endswitch;
        endif;
        return $models;
    }
    private function loadPromotionables(){
        if ($this->promotion->type && $this->promotion->type != 'Todos'):
            switch($this->promotion->type):
                case 'Producto':
                    $this->promotionablesArray = $this->promotion->products()->pluck('promotionable_id')->toArray();
                    break;
                case 'Categoría':
                    $this->promotionablesArray = $this->promotion->productCategories()->pluck('promotionable_id')->toArray();
                    break;
                case 'Marca':
                    $this->promotionablesArray = $this->promotion->productBrands()->pluck('promotionable_id')->toArray();
                    break;
            endswitch;
        endif;
    }
    public function changePromotionType(){
        $this->promotionablesArray = [];
        $this->promotion->conditional = null;
    }
    private function applyFilter($models){
        if($this->search):
            $models = $models->where('name', 'LIKE', "%{$this->search}%");
        endif;
        return $models;
    }
}