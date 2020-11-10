<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Cart;
use Session;
use App\Jobs\UpdateCart;

class CartController extends Controller
{
    
    public function addCartAjax(Request $request)
    {
        $data = $request->product;
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['product_id'] == $data['product_id']){
                    $is_avaiable++;
                    $cart[$key]['product_qty']+=1;
                    Session::put('cart', $cart);
                    Session::save();
                    dd(Session::get('cart'));
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_id' => $data['product_id'],
                    'product_name' => $data['product_name'],
                    'product_image' => $data['product_image'],
                    'product_qty' => '1',
                    'product_price' => $data['product_price'],
                );
                Session::put('cart', $cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_id' => $data['product_id'],
                'product_name' => $data['product_name'],
                'product_image' => $data['product_image'],
                'product_qty' => '1',
                'product_price' => $data['product_price'],
            );
        }
        Session::put('cart', $cart);
        Session::save();
    }
    public function addToCart(Request $request)
    {
        $productId = $request->productId;
        $quantity = $request->qty;
        $product = DB::table('tbl_product')->where('product_id', $productId)->first();
        $data['id'] =  $productId;
        $data['name'] = $product->product_name;
        $data['price'] = $product->product_price;
        $data['qty'] = $quantity;
        $data['weight'] = '550';
        $data['options']['image'] = $product->product_image;
        Cart::add($data);
        // Cart::remove('aa76da0cfc10ca98cae4de80d262bf2b');
        foreach (Cart::content() as $key => $value) {
            $rowId = $value->rowId;
        }
        return Cart::get($rowId);
    } 
    public function getCart()
    {
        return Cart::content();
    } 
    public function deleteProductCart(Request $request)
    {   
        $rowId = $request->rowId;
        Cart::remove($rowId);
    }
    public function deleteCart(Request $request)
    {   
        Cart::destroy();
    }
}
