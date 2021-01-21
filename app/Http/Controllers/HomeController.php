<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{
    public function index()
    {
        //Hiện danh mục
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        //Hiện thương hiệu
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        //Hiện sản phẩm
        $all_product = DB::table('tbl_product')->orderby('product_id','desc')->paginate(9);
        return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product);
    }


    //Tìm kiếm sản phẩm theo từ khóa
    public function search(Request $request){

        $keywords = $request->keywords_submit;
        //Hiện danh mục
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        //Hiện thương hiệu
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        //Tìm kiếm sản phẩm theo tên trong bất kì vị trí nào
        $search_product = DB::table('tbl_product')->where('product_name','like','%' .$keywords.'%')->get();
        return view('pages.sanpham.search')->with('category',$cate_product)->with('brand',$brand_product)
        ->with('search_product',$search_product);
    }
}
