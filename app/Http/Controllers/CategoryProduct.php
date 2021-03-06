<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Category;
use Illuminate\Support\Facades\Redirect;
use Session;

class CategoryProduct extends Controller
{
    // Start Admin page
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('/admin-page')->send();
        }
    }
    public function getCategory()
    {
        $this->AuthLogin();
        return view('admin.add_category_product');
    }
    public function showCategory()
    {
        // $category_product = DB::table('tbl_category_product')->get();
        $category_product = Category::orderBy('category_id','desc')->get();
        $manage = view('admin.show_category_product')->with('category_product',$category_product);

        return view('admin_layout')->with('admin.show_category_product', $manage);
    }
    public function addCategory(Request $request)
    {
        // $data = array();
        // $data['category_name'] = $request->category_product_name;
        // $data['category_desc'] = $request->category_product_desc;
        // $data['category_status'] = $request->category_product_status;
        
        // DB::table('tbl_category_product')->insert($data);
        $data = $request->all();
        $category = new Category();
        $category->category_name = $data['category_product_name'];
        $category->category_desc = $data['category_product_desc'];
        $category->category_status = $data['category_product_status'];
        $category->save();
        
        Session::put('message','Add new category sucessfully!');
        return Redirect::to('get-category');
    }
    public function editCategory($category_product_id)
    {
        // $edit_category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        $edit_category_product = Category::find($category_product_id);
        $manage = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);

        return view('admin_layout')->with('admin.edit_category_product', $manage);
    
    }
    public function updateCategory(Request $request, $category_product_id)
    {
        $data = $request->all();
        $category = Category::find($category_product_id);
        $category->category_name = $data['category_product_name'];
        $category->category_desc = $data['category_product_desc'];
        $category->category_status = $data['category_product_status'];      
        $category->save();
        // DB::table('tbl_category_product')->where('category_id', $category_product_id)->update($data);
        Session::put('message','Edit category sucessfully!');
        return Redirect::to('all-category');
    
    }
    public function deleteCategory($category_product_id)
    {
       DB::table('tbl_category_product')->where('category_id', $category_product_id)->delete();
        Session::put('message','Delete category sucessfully!');
        return Redirect::to('all-category');
    
    }
    // End Admin page
    

}
