<?php

namespace App\Http\Controllers\Ecommerce\Currency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CurrencyController extends Controller
{
    public function __invoke($currency){
        Session::put('currency', $currency);
        return Redirect::back();
    }
}
