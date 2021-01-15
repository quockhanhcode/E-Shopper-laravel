<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
//Sử dụng model brand
use App\Models\Brand;

class BrandProduct extends Controller
{
    //Kiểm tra đăng nhập
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }
        else
        {
            return Redirect::to('admin')->send();
        }
    }

    public function add_brand_product(){
        $this->AuthLogin();
        return view('admin.add_brand_product');
    }

    public function all_brand_product(){
        $this->AuthLogin();
        //$all_brand_product = DB::table('tbl_brand')->get();
        //$all_brand_product = Brand::all();  
        //Sắp xếp thwo kieu:
        $all_brand_product = Brand::orderBy('brand_id','DESC')->get();  
        $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
        return view('admin_layout')->with('admin.all_brand_product',$manager_brand_product);
    }

    public function save_brand_product(Request $request){

        $this->AuthLogin();

        // $data = array();
        // //Lấy dữ liệu theo biến name

        // //      Tên cột trong database      tên name dc lấy trong form từ trường "name" từ add_brand
        // $data['brand_name'] = $request->brand_product_name;
        // $data['brand_desc'] = $request->brand_product_desc;
        // $data['brand_status'] = $request->brand_product_status;
        // DB::table('tbl_brand')->insert($data);

        $data = $request->all(); // lấy tất cả dữ liệu
        $brand = new Brand(); //Lấy ra class của model Brand

       //      brand lây từ model     brand từ name
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->brand_status = $data['brand_product_status'];
        $brand->save();

        Session::put('message','Thêm thương hiệu thành công');
        return Redirect::to('add-brand-product');
    }

    public function edit_brand_product($brand_product_id)
    {
        //$edit_brand_product = DB::table('tbl_brand')->where('brand_id',$brand_product_id)->get();

       $edit_brand_product = Brand::where('brand_id',$brand_product_id)->get();

        // $edit_brand_product = Brand::find($brand_product_id);

        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);
        return view('admin_layout')->with('admin.edit_brand_product',$manager_brand_product);
    }

    public function update_brand_product(Request $request,$brand_product_id){
        $this->AuthLogin();
        // $data = array();
        
        // $data['brand_name'] = $request->brand_product_name;
        // $data['brand_desc'] = $request->brand_product_desc;
        //DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update($data);

        $data = $request->all(); // lấy tất cả dữ liệu

        $brand = Brand::find($brand_product_id); //Lấy ra class của model Brand
       //      brand lây từ model     brand từ name
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->save();
        return Redirect::to('all-brand-product');

    }

    public function delete_brand_product($brand_product_id){
        //DB::table('tbl_brand')->where('brand_id',$brand_product_id)->delete();
        $brand = Brand::find($brand_product_id);
        $brand->delete();
        return Redirect::to('all-brand-product');
    }

    //Tìm kiếm sản phẩm theo thương hiệu
    public function show_brand_home($brand_id){
        //Hiện danh mục
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        //Hiện thương hiệu
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        //Lấy ra thương hiệu sản phẩm
        $brand_by_id = DB::table('tbl_product')
        ->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')
        ->where('tbl_product.brand_id',$brand_id)->paginate(5);
        return view('brand.show_brand')
        ->with('category',$cate_product)
        ->with('brand',$brand_product)->with('brand_by_id',$brand_by_id);
    }

}
