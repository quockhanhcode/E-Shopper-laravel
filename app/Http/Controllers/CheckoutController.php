<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CheckoutController extends Controller
{



    public function login_checkout(){
        //Hiện danh mục
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        //Hiện thương hiệu
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        return view('checkout.login_checkout')->with('category',$cate_product)->with('brand',$brand_product);
    }

    public function add_customer(Request $request){
        $data = array();
            //Dữ liệu từ mysql    name từ form đăng kí
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = $request->customer_password;
        $data['customer_phone'] = $request->customer_phone;

        //Hàm insertGetId vừa insert vào thì nó sẽ lấy id vừa được tạo
        $customer_id = DB::table('tbl_customer')->insertGetId($data);

        Session::put('customer_id', $customer_id);
        Session::put('customer_name',$request->customer_name);

        return Redirect('/checkout');
    }

    public function checkout(){
        //Hiện danh mục
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        //Hiện thương hiệu
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        return view('checkout.show_checkout')->with('category',$cate_product)->with('brand',$brand_product);
    }

    public function save_checkout_customer(Request $request){
        $data = array();
        //Dữ liệu từ mysql    name từ form đăng kí
    $data['shipping_email'] = $request->shipping_email;
    $data['shipping_name'] = $request->shipping_name;
    $data['shipping_address'] = $request->shipping_address;
    $data['shipping_phone'] = $request->shipping_phone;
    $data['shipping_notes'] = $request->shipping_notes;

    //Hàm insertGetId vừa insert vào thì nó sẽ lấy id vừa được tạo
    $shipping_id = DB::table('tbl_shipping')->insertGetId($data);

    Session::put('shipping_id', $shipping_id);
    return Redirect('/payment');
    }

    public function payment(){

    }

    public function logout_checkout(){
        Session::flush(); //hàm flush để xóa toàn bộ dữ liệu ra Session
        return Redirect('login-checkout');
    }

    public function login_customer(Request $request){
        
        $email = $request->email_account;
        $password = $request->password_account;

        $result = DB::table('tbl_customer')->where('customer_email',$email)->where('customer_password',$password)->first();

        if($result){
            Session::put('customer_id',$result->customer_id);
            return Redirect::to('/checkout');
        }
        else
        {
            return Redirect('/login-checkout');
        }
    }
}
