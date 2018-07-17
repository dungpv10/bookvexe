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
        Role::create([
            'name' => 'admin',
            'label' => 'Admin',
        ]);
        if (! Role::where('name', 'member')->first()) {
            Role::create([
                'name' => 'member',
                'label' => 'Khách hàng',
            ]);
            Role::create([
                'name' => 'agent',
                'label' => 'Nhà xe',
            ]);
            Role::create([
                'name' => 'staff',
                'label' => 'Nhân viên',
            ]);
        }
    }
}
