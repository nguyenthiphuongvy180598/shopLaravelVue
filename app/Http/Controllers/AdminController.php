<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
use Mail;
session_start();

class AdminController extends Controller
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
    public function index()
    {
        return view('admin_login');
    }
    public function showDashboard()
    {
        $this->AuthLogin();
        return view('admin.dashboard');
    }
    public function dashboard(Request $request)
    {
        $admin_email = $request->admin_email;
        $admin_password = ($request->admin_password);
        $result = DB::table('tbl_admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
       if($result){
           Session::put('admin_name', $result->admin_name);
           Session::put('admin_id', $result->admin_id);
           return Redirect::to('/dashboard');
        }else{
            Session::put('message', 'Incorrect email or password');
            return Redirect::to('/admin-page');
        }
    }
    // tmp to test send mail
    public function sendMail()
    {
        $to_name = "Vy Nguyen";
        $to_email = "vyvynguyen180598@gmail.com";//send to this email

        $data = array("name"=>"Mail send from admincontroller","body"=>"for testing sending email"); //body of mail.blade.php
    
        Mail::send('admin.send_mail',$data,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('test mail google');//send this mail with subject
            $message->from($to_email,$to_name);//send from this mail
        });
        return Redirect::to('/dashboard');
    }
}
