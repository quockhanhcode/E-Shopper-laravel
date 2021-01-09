<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Cart;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CartController extends Controller
{

    public function cart(){
        //Hiện danh mục
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        //Hiện thương hiệu
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        return view('cart.show_cart')->with('category',$cate_product)->with('brand',$brand_product);;
    }

    public function save_cart(Request $request){
        //Lấy ra id sản phẩm
        $productId = $request->productid_hiden;
        $quantity = $request->qty;

        $product_info = DB::table('tbl_product')->where('product_id',$productId)->first();

        //Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        //Khai báo các trường của sp
        $data['id'] = $product_info->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = '123';
        $data['options']['image'] = $product_info->product_image;
        Cart::add($data);
        //Sau khi đã thêm được sản phẩm thì quay về trang hiện sp
        return Redirect::to('/show-cart');

    } 
    
    public function show_cart()
    {
        //Hiện danh mục
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        //Hiện thương hiệu
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        return view('cart.show_cart')->with('category',$cate_product)->with('brand',$brand_product);

    }

    public function delete_to_cart($rowId){
        Cart::update($rowId,0);
        return Redirect::to('/show-cart');
    }

    //Update số lượng sp
    public function update_cart_quantity(Request $request){
        $rowId = $request->rowId_cart; //rowId_cart này là name từ file show_cart dòng 44
        $qty = $request->cart_quantity; //... dòng 43
        Cart::update($rowId,$qty);
        return Redirect::to('/show-cart');
    }
}
