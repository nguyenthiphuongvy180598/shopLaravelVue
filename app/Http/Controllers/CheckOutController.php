<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Cart;
use Session;
use App\Jobs\UpdateCart;

class CheckOutController extends Controller
{
    public function addCustomer(Request $request)
    {
        $data = array();
        $data['customer_name'] = $request->name;
        $data['customer_email'] = $request->email;
        $data['customer_password'] = md5($request->password);
        $data['customer_phone'] = $request->phone;
        $customer_id = DB::table('tbl_customers')->insertGetId($data);
        Session::put('customer_id', $customer_id);
        return $customer_id;
    }
    public function loginCheckout(Request $request)
    {
        $data = array();
        $customer_email = $request->email;
        $customer_password = md5($request->password);
        $result = DB::table('tbl_customers')->where('customer_email', $customer_email)->where('customer_password', $customer_password)->first();
        if($result){
            Session::put('customer_id', $result->customer_id);
            return $result->customer_id;
        }
    }
    public function validateCheckout(Request $request)
    {
        $cartItems = $request->cart;
        UpdateCart::dispatchNow($cartItems);
        if(!Session::has('customer_id')){
            abort(401, "Haven't loggin");
        }
    }
    public function saveCheckout(Request $request)
    {
        $data = array();
        $data['shipping_name'] = $request->name;
        $data['shipping_email'] = $request->email;
        $data['shipping_address'] = $request->address;
        $data['shipping_notes'] = $request->notes;
        $data['shipping_phone'] = $request->phone;
        $data['customer_id'] = $request->customer_id;
        $shippingId = DB::table('tbl_shipping')->insertGetId($data);
        Session::put('shipping_id', $shippingId);
        
    }
    public function saveOrder(Request $request)
    {
        //insert payment
        $payment_data = array();
        $payment_data['payment_method'] = $request->payment_method;
        $payment_data['payment_status'] = 'wait for handling';
        $paymentId = DB::table('tbl_payment')->insertGetId($payment_data);
        // insert order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $paymentId;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'wait for handling';
        $orderId = DB::table('tbl_order')->insertGetId($order_data);

        //insert order_details
        $content = Cart::content();
        foreach($content as $v_content)
        {
            $data = array();
            $data['order_id'] = $orderId;
            $data['product_id'] = $v_content->id;
            $data['product_name'] = $v_content->name;
            $data['product_price'] = $v_content->price;
            $data['product_sale_quantity'] = $v_content->qty;
            DB::table('tbl_order_details')->insert($data);
        }
        Cart::destroy();
    }
}
