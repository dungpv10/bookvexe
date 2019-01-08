<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            [
                'name' => 'root',
                'label' => 'Root',
            ],
            [
                'name' => 'admin',
                'label' => 'Quản lý nhà xe',
            ],
            [
                'name' => 'staff',
                'label' => 'Nhân viên',
            ],
            [
                'name' => 'customer',
                'label' => 'Khách hàng',
            ]
        ]);
    }
}
