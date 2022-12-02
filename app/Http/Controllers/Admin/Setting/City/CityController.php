<?php

namespace App\Http\Controllers\Admin\Setting\City;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(){
        return view('admin.setting.city.index');
    }
}
