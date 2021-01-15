<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; //Dùng csdl trong mysql

//Thư viện dùng cho session
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
use Auth;

class AdminController extends Controller
{
    //Kiểm tra đăng nhập
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }
        else
        {
            return Redirect::to('admin')->send();
        }
    }

    public function index()
    {
        return view('admin_login');
    }

    public function show_dashboard(){
        $this->AuthLogin(); //Nếu có đăng nhập thì sẽ chuyển đến trang dashboard
        return view('admin.dasboard');
    }

    //Đăng Nhập
    public function dashboard(Request $request){
        $admin_email = $request->admin_email;
        $admin_password= md5($request->admin_password);

        $result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        
        if($result){
            Session::put('admin_name',$result->admin_name);
            Session::put('admin_id',$result->admin_id);
            return Redirect::to('/dashboard');
        }
        else{
            Session::put('message','Nhập Lại');
            return Redirect::to('/admin');
        }
    }

    //Đăng Xuất
    public function logout(){
        $this->AuthLogin(); //Nếu có đăng nhập thì mới logout
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');
    }
}
