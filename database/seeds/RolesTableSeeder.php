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
                'module_ids' => '0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15'
            ],
            [
                'name' => 'admin',
                'label' => 'Quản lý nhà xe',
                'module_ids' => '0,1,2,3,4,5,6'
            ],
            [
                'name' => 'staff',
                'label' => 'Nhân viên',
                'module_ids' => ''
            ],
            [
                'name' => 'customer',
                'label' => 'Khách hàng',
                'module_ids' => ''
            ]
        ]);
    }
}
