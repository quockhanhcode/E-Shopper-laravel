<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //Tự động tạo ra 2 trường create at & update at
    // public $timestamps = false; // Set false ko cho chạy 2 trường trên
    //Có thể chèn dữ liệu vào
    protected $fillable = ['brand_name','brand_desc','brand_status'];
    protected $primaryKey = 'brand_id';
    protected $table = 'tbl_brand';
}
