<?php

namespace App\Http\Controllers\Admin\Setting\ShippingZone;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShippingZoneController extends Controller
{
    public function index(){
        return view('admin.setting.shipping-zone.index');
    }
}
