<?php

namespace App\Http\Controllers\Ecommerce\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        return view('ecommerce.contact.index');
    }
}
