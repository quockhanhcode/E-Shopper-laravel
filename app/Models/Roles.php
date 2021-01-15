<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];
    protected $primaryKey = 'id_roles';
    protected $table = 'tbl_roles';

    //Hàm này nghĩa là Roles là quyền thuộc nhiều admin
    //Ngược lại admin này có rất nhiều quyền
    public function admin(){
        return $this->belongsToMany('App\Models\Admin');
    }
}
