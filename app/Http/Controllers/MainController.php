<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Session;

class MainController extends Controller
{
    
    public function getCustomerId(Request $request)
    {
        return Session::get('customer_id');
    }
    public function logout(Request $request)
    {
        Session::forget('customer_id');
    }
}
