<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    public function index(){
        $categories = ProductCategory::query()->with('allChildrens')->whereNull('parent_id')->get();
        dd($categories);
    }
}
