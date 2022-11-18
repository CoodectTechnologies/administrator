<?php

namespace App\Http\Livewire\Ecommerce\Layouts;

use App\Models\ProductCategory;
use Livewire\Component;

class MenuCategory extends Component
{
    public function render(){
        $categories = ProductCategory::query()->with('allChildrens')->whereNull('parent_id')->get();
        return view('livewire.ecommerce.layouts.menu-category', compact('categories'));
    }
}
