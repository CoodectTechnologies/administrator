<?php

namespace App\Http\Controllers\Ecommerce\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AboutController extends Controller
{
    public function index(){
        $about = Cache::get('about') ?? null;
        return view('ecommerce.about.index', compact('about'));
    }
}
