<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Mail;

class MailController extends Controller
{
    public function send_mail(){
         $to_name = "Khanh Huynh";
         $to_mail = "01673khanh@gmail.com";

         $data = array("name"=>"Mail từ Khanh Huynh","body"=>"Kiểm tra sản phẩm đã đặt");

         Mail::send('mail.send_mail',$data,function($message) use ($to_name,$to_mail){
             $message->to($to_mail)->subject('Test mail');
             $message->from($to_mail,$to_name);
         });

         return Redirect::to('/');
    }
}
