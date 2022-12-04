<?php

use App\Http\Controllers\Ecommerce\About\AboutController;
use App\Http\Controllers\Ecommerce\Cart\CartController;
use App\Http\Controllers\Ecommerce\Category\CategoryController;
use App\Http\Controllers\Ecommerce\Contact\ContactController;
use App\Http\Controllers\Ecommerce\Currency\CurrencyController;
use App\Http\Controllers\Ecommerce\Feed\FacebookController;
use App\Http\Controllers\Ecommerce\Feed\GoogleController;
use App\Http\Controllers\Ecommerce\Home\HomeController;
use App\Http\Controllers\Ecommerce\Product\ProductController;
use App\Http\Controllers\Ecommerce\Language\LanguageController;
use Illuminate\Support\Facades\Route;

//Home
Route::get('/', [HomeController::class, 'index'])->name('home.index');
//Language
Route::get('/lang/{language}', LanguageController::class)->name('language');
//Currency
Route::get('/currency/{currency}', CurrencyController::class)->name('currency');
//About
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
//Contact
Route::get('/contacto', [ContactController::class, 'index'])->name('contact.index');
//Category
Route::resource('/categorias', CategoryController::class)->parameters(['categorias' => 'category'])->names('category');
//Product
Route::resource('/productos', ProductController::class)->parameters(['productos' => 'product'])->names('product');
//Cart
Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
//Feed
Route::prefix('feed')->name('feed.')->group(function (){
    Route::redirect('/', '/ecommerce/feed/facebook');
    Route::get('/facebook', [FacebookController::class, 'index'])->name('facebook.index');
    Route::get('/google', [GoogleController::class, 'index'])->name('google.index');
});
