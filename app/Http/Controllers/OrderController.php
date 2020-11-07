<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
class OrderController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('/admin-page')->send();
        }
    }
    public function manageOrder()
    {
        $this->AuthLogin();
        $all_order = DB::table('tbl_order')
        ->join('tbl_customers','tbl_customers.customer_id', '=', 'tbl_order.customer_id')
        ->select('tbl_order.*', 'tbl_customers.customer_name')
        ->orderby('tbl_order.order_id','desc')->get();
        $manage = view('admin.manage_order')->with('all_order',$all_order);

        return view('admin_layout')->with('admin.manage_order', $manage);
    }
    public function viewOrder($order_id)
    {
        $order_by_id = DB::table('tbl_order')->where('tbl_order.order_id',$order_id)
        ->join('tbl_customers','tbl_customers.customer_id', '=', 'tbl_order.customer_id')
        ->join('tbl_shipping','tbl_shipping.shipping_id', '=', 'tbl_order.shipping_id')
        ->join('tbl_order_details','tbl_order_details.order_id', '=', 'tbl_order.order_id')
        ->select('tbl_customers.*', 'tbl_shipping.*','tbl_order_details.*')->get();
        $manage = view('admin.view_order')->with('order_by_id',$order_by_id);

        return view('admin_layout')->with('admin.view_order', $manage);

    }
}
