<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Roles;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Khi phát hiện csdl thì sẽ xóa tất cả dữ liệu trong table Roles
        Roles::truncate();
        //Tạo quyền vào bảng-số lượng tùy chọn
        Roles::create(['name' => 'admin']);
        Roles::create(['name' => 'author']);
        Roles::create(['name' => 'user']);
    }
}
