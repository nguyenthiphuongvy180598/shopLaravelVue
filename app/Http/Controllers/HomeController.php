<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    // Start App page
    public function getCategories()
    {
        $category = DB::table('tbl_category_product')->where('category_status', '1')
        ->orderBy('category_id','desc')->get();

        return $category;
    }
    public function getProducts(Request $request)
    {
        $category_name = $request->input('categoryName');
        if($category_name) {
            $cate = DB::table('tbl_category_product')->where('category_name', $category_name)->first();
            return  DB::table('tbl_product')->where('product_status', '1')
            ->where('category_id', $cate->category_id)
            ->orderBy('product_id')->get();
        
        }
        return  DB::table('tbl_product')->where('product_status', '1')
        ->orderBy('product_price')->limit(6)->get();
    }
    public function getProductDetails(Request $request)
    {
        $productId = $request->input('productId');
        return  DB::table('tbl_product')->where('product_status', '1')
            ->where('product_id', $productId)->get();
    }
    public function getRecommendList(Request $request)
    {
        $productId = $request->input('productId');
        $product = DB::table('tbl_product')->where('product_id', $productId)->get();
        foreach ($product as $key => $value) {
            $category_id = $value->category_id;
        }
        $recommendList = DB::table('tbl_product')->where('category_id', $category_id)
        ->where('product_status', '1')->whereNotIn('product_id', [$productId])->get();
        return  $recommendList;
    }
    public function apiProduct($product_name)
    {
        $product = DB::table('tbl_product')->where('product_name', $product_name)->get();
        foreach ($product as $key => $value) {
            $productId = $value->product_id;
        }
        
        return view('welcome');
    }
    // End App page
}
