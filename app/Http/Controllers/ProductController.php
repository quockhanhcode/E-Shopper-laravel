<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller
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
    public function add_product(){
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        return view('admin.add_product')->with('category_product',$cate_product)->with('brand_product',$brand_product);
    }

    public function all_product(){
        $this->AuthLogin();
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id','desc')->get();
        $manager_product = view('admin.all_product')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.all_product',$manager_product);
    }

    public function save_product(Request $request){
        $this->AuthLogin();
        $data = array();
        //Lấy dữ liệu theo biến name

        //      Tên cột trong database tên name dc lấy trong form từ trường "name" từ add_product
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->category_product;
        $data['brand_id'] = $request->brand_product;
        $data['product_status'] = $request->product_status;

        //Upload ảnh:
        $get_image = $request->file('product_image');
        if($get_image){
            //Lấy tên sp
            $get_name_image = $get_image->getClientOriginalName();
            //Tách chuỗi(.ipg/png)
            $name_image = current(explode('.',$get_name_image));
            //Lấy đuôi mở rộng của file hình ảnh
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            //Hình ảnh gửi đến đường dẫn chỉ định
            $get_image->move('public/upload/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('all-product');

        }
    }

    public function edit_product($product_id)
    {
        $this->AuthLogin();
        
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();

        //Lấy ra danh mục & thương hiệu của 2 bảng 
        $manager_product = view('admin.edit_product')->with('edit_product',$edit_product)
        ->with('category_product',$cate_product)
        ->with('brand_product',$brand_product);

        return view('admin_layout')->with('admin.edit_product',$manager_product);
        
    }

    public function update_product(Request $request,$product_id){
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->category_product;
        $data['brand_id'] = $request->brand_product;
        // $data['product_status'] = $request->product_status;
       //Upload ảnh:
       $get_image = $request->file('product_image');
       if($get_image){
           //Lấy tên sp
           $get_name_image = $get_image->getClientOriginalName();
           //Tách chuỗi(.ipg/png)
           $name_image = current(explode('.',$get_name_image));
           //Lấy đuôi mở rộng của file hình ảnh
           $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
           //Hình ảnh gửi đến đường dẫn chỉ định
           $get_image->move('public/upload/product',$new_image);
           $data['product_image'] = $new_image;
           DB::table('tbl_product')->where('product_id', $product_id)->update($data);
           Session::put('message','Cập nhật sản phẩm thành công');
           return Redirect::to('all-product');
       }
       else
       DB::table('tbl_product')->where('product_id', $product_id)->update($data);
           Session::put('message','Cập nhật sản phẩm thành công');
           return Redirect::to('all-product');
    }

    public function delete_product($product_id){
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        return Redirect::to('all-product');
    }

    //Xem chi tiết sản phẩm
    public function detail_product($product_id){

        //Hiện danh mục
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        //Hiện thương hiệu
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        $details_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id',$product_id)->get();


        
        //Hiển thị sản phẩm liên quan (Danh mục)
        foreach($details_product as $key=>$value){
            $category_id = $value->category_id;
        }

        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id',$category_id)
        ->whereNotIn('tbl_product.product_id',[$product_id]) // Loại bỏ ID sản phẩm hiện có
        ->get();
        
        return view('pages.sanpham.show_details')->with('category',$cate_product)
        ->with('brand',$brand_product)->with('product_details',$details_product)
        ->with('related',$related_product); // hiện danh sách sản phẩm liên quan
    }
}
