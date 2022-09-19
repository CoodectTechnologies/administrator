<?php

use App\Http\Controllers\Web\Home\HomeController;
use App\Http\Controllers\Web\Language\LanguageController;
use Illuminate\Support\Facades\Route;

//Home
Route::get('/', [HomeController::class, 'index'])->name('home.index');
//Language
Route::get('/lang/{language}', LanguageController::class)->name('language');