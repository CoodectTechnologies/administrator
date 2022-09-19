<?php

use App\Http\Controllers\Auth\SocialController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Access
Auth::routes(['register' => false]);
//Socialite
Route::get('login/google', [SocialController::class, 'googleRedirect'])->name('login.google');
Route::get('login/google/callback', [SocialController::class, 'loginWithGoogle'])->name('login.google.redirect');