<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    public $timestamps = false;
    protected $fillable = ['admin_email','admin_password','admin_name','admin_phone'];
    protected $primaryKey = 'admin_id';
    protected $table = 'tbl_admin';

    //Admin có nhiều quyền
    public function roles(){
        return $this->belongsToMany('App\Models\Roles');
    }

    public function getAuthPassword(){
        return $this->admin_password;
    }

    public function hasRole($role){
        return null !== $this->roles()->where('name',$role)->first();
    }
    
}
