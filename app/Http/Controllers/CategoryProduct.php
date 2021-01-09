<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;

session_start();

class CategoryProduct extends Controller
{
    //Kiểm tra đăng nhập
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }

    public function add_category_product()
    {
        $this->AuthLogin();
        return view('admin.add_category_product');
    }

    public function all_category_product()
    {
        $this->AuthLogin();
        $all_category_product = DB::table('tbl_category_product')->get();
        $manager_category_product = view('admin.all_category_product')->with('all_category_product', $all_category_product);
        return view('admin_layout')->with('admin.all_category_product', $manager_category_product);
    }

    public function save_category_product(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        //Lấy dữ liệu theo biến name

        //      Tên cột trong database      tên name dc lấy trong form từ trường "name" từ add_category
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;

        DB::table('tbl_category_product')->insert($data);
        Session::put('message', 'Thêm danh mục thành công');
        return Redirect::to('add-category-product');
    }

    public function edit_category_product($category_product_id)
    {
        $this->AuthLogin();
        $edit_category_product = DB::table('tbl_category_product')->where('category_id', $category_product_id)->get();
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product', $edit_category_product);
        return view('admin_layout')->with('admin.edit_category_product', $manager_category_product);
    }

    public function update_category_product(Request $request, $category_product_id)
    {
        $this->AuthLogin();
        $data = array();

        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;

        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update($data);
        return Redirect::to('all-category-product');

    }

    public function delete_category_product($category_product_id)
    {
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->delete();
        return Redirect::to('all-category-product');
    }

    //Tìm kiếm sản phẩm theo danh mục
    public function show_category_home($category_id)
    {
        //Hiện danh mục
        $cate_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        //Hiện thương hiệu
        $brand_product = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();

        //Lấy ra danh mục sản phẩm
        $category_by_id = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')
            ->where('tbl_product.category_id', $category_id)->paginate(5);
        return view('category.show_category')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)->with('category_by_id', $category_by_id);
    }
}
