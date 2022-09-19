<?php

namespace App\Http\Controllers\Admin\Setting\InfoAccountBank;

use App\Http\Controllers\Controller;

class InfoAccountBankController extends Controller
{
    public function index(){
        return view('admin.setting.info-account-bank.index');
    }
}
