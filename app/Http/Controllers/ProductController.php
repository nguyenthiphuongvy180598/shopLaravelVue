<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
class ProductController extends Controller
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
    public function getProduct()
    {
        $this->AuthLogin();
        $category_product = DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
        return view('admin.add_product')->with('category_product', $category_product);
    }
    public function showProduct()
    {
        $product = DB::table('tbl_product')->join('tbl_category_product', function($join){
            $join->on('tbl_product.category_id','=','tbl_category_product.category_id');
        })->get();
        $manage = view('admin.show_product')->with('product',$product);

        return view('admin_layout')->with('admin.show_product', $manage);
    }
    public function addProduct(Request $request)
    {
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price;
        $data['product_status'] = $request->product_status;
        $data['category_id'] = $request->product_cate;
        $get_image = $request->file('product_image');
        if($get_image){
            $get_image_name = $get_image->getClientOriginalName();
            $image_name =current(explode('.', $get_image_name));
            $new_image = $image_name.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('/xampp/htdocs/shopbanhanglaravel/public/uploads/product', $new_image);
           
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message','Add new product sucessfully!');
            return Redirect::to('get-product');
        }
        $data['product_image'] = '';
        DB::table('tbl_product')->insert($data);
        Session::put('message','Add new product sucessfully!');
        return Redirect::to('get-product');
    }
    public function editProduct($product_id)
    {
        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        $category_product = DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
        $manage = view('admin.edit_product')->with('edit_product',$edit_product)->with('category_product',$category_product);;
        
        return view('admin_layout')->with('admin.edit_product', $manage);
    
    }
    public function updateProduct(Request $request, $product_id)
    {
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price;
        $data['product_status'] = $request->product_status;
        $data['category_id'] = $request->product_cate;
        $get_image = $request->file('product_image');
        if($get_image){
            $get_image_name = $get_image->getClientOriginalName();
            $image_name =current(explode('.', $get_image_name));
            $new_image = $image_name.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('/xampp/htdocs/shopbanhanglaravel/public/uploads/product', $new_image);
           
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id', $product_id)->update($data);
            Session::put('message','Edit product sucessfully!');
            return Redirect::to('all-product');
        }
        DB::table('tbl_product')->where('product_id', $product_id)->update($data);
        Session::put('message','Edit product sucessfully!');
        return Redirect::to('all-product');
    
    }
    public function deleteProduct($product_id)
    {
       DB::table('tbl_product')->where('product_id', $product_id)->delete();
        Session::put('message','Delete product sucessfully!');
        return Redirect::to('all-product');
    }
}
