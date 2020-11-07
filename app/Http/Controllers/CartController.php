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
}
