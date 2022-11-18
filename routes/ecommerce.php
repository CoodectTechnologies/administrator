<?php

use App\Http\Controllers\Ecommerce\Category\CategoryController;
use App\Http\Controllers\Ecommerce\Currency\CurrencyController;
use App\Http\Controllers\Ecommerce\Home\HomeController;
use App\Http\Controllers\Ecommerce\Product\ProductController;
use App\Http\Controllers\Web\Language\LanguageController;
use Illuminate\Support\Facades\Route;

//Home
Route::get('/', [HomeController::class, 'index'])->name('home.index');
//Currency
Route::get('/currency/{currency}', CurrencyController::class)->name('currency');
//Category
Route::resource('/categorias', CategoryController::class)->names('category');
//Product
Route::resource('/productos', ProductController::class)->names('product');
