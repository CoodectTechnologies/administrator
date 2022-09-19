<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return view('admin.catalog.product.general.index');
    }
    public function create(){
        return view('admin.catalog.product.general.create');
    }
    public function edit(Product $product){
        return view('admin.catalog.product.general.edit', compact('product'));
    }
}
