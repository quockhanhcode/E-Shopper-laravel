<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Admin;
use App\Models\Roles;

use Auth;

use Illuminate\Support\Facades\Redirect;


class AuthController extends Controller
{
    public function register_auth(){
        return view('custom_auth.register');
    }

    public function register(Request $request){
        $this->validation($request);
        $data = $request->all();
        //lấy dữ liệu 
        $admin = new Admin();
        $admin->admin_email = $data['admin_email'];
        $admin->admin_password = md5($data['admin_password']);
        $admin->admin_name = $data['admin_name'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->save();
        return Redirect::to('register-auth');
    }

    //Hàm kiểm tra nhập liệu và được gọi ngược lại trên hàm register
    public function validation($request){
        return $this->validate($request,[
            'admin_name'=>'required|max:255',
            'admin_phone'=>'required|max:255',
            'admin_email'=>'required|email|max:255',
            'admin_password'=>'required|max:255',
        ]);
    }

    public function login_auth(){
        return view('custom_auth.login_auth');
    }

    public function login(Request $request){
        return $this->validate($request,[
            'admin_email'=>'required|email|max:255',
            'admin_password'=>'required|max:255',
        ]);

        // $data = $request->all();

        if(Auth::attempt(['admin_email' => $request->admin_email,'admin_password' => $request->admin_password])){
           return Redirect::to('/dashboard');
        }
        else
        {
            return Redirect::to('/login-auth');
        }
    }
}
