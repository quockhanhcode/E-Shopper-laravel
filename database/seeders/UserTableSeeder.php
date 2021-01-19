<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\Roles;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        //Lấy ra các quyền từ bảng Roles
        $adminRoles = Roles::where('name','admin')->first();
        $authorRoles = Roles::where('name','author')->first();
        $userRoles = Roles::where('name','user')->first();

        $admin = Admin::create([
            'admin_email'=> 'adminkhanh@gmail.com',
            'admin_password'=> md5('123'),
            'admin_name'=> 'Khánh Admin',
            'admin_phone'=> '999999',
        ]);

        $author = Admin::create([
            'admin_email'=> 'authorkhanh@gmail.com',
            'admin_password'=> md5('123'),
            'admin_name'=> 'Khánh Author',
            'admin_phone'=> '88888',
        ]);

        $user = Admin::create([
            'admin_email'=> 'userkhanh@gmail.com',
            'admin_password'=> md5('123'),
            'admin_name'=> 'Khánh User',
            'admin_phone'=> '77777',
        ]);

        //Gán quyền cho mỗi user vừa tạo
        $admin->roles()->attach($adminRoles);
        $author->roles()->attach($authorRoles);
        $user->roles()->attach($userRoles);
    }
}
