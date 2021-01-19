<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use App\Models\Roles;
use App\Models\Admin;

class UserController extends Controller
{
    //Hiển thị danh sách users
    public function all_users(){
        $all_user = Admin::with('roles')->orderby('admin_id','desc')->paginate(5);
        return view('users.show_users')->with('all_user',$all_user);
    }

    //Cấp quyền cho từng user
    public function assign_roles(Request $request){
        //So sánh user trong database với user được chọn
        $user = Admin::where('admin_email',$request->admin_email)->first();
        //Loại bỏ hết tất cả các quyền
        $user->roles()->detach();
        //nếu check vào quyền author thì sẽ lấy quyền author có trong models Role thêm vài tài khoảng đó
        if($request->author_roles){
            $user->roles()->attach(Roles::where('name','author')->first());
        }
        if($request->admin_roles){
            $user->roles()->attach(Roles::where('name','admin')->first());
        }
        if($request->user_roles){
            $user->roles()->attach(Roles::where('name','user')->first());
        }
        return Redirect::to('all-users');
    }
}
