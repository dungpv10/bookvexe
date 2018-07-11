<?php

use Illuminate\Database\Seeder;

class AmenityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $amenities = [
            [
                'amenity_name' => 'Wifi',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ],
            [
                'amenity_name' => 'Nước uống',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ],
            [
                'amenity_name' => 'Sạc điện thoại',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ],
            [
                'amenity_name' => 'Nghỉ giữa trạm',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ]
        ];

        \App\Models\Amenity::insert($amenities);
    }
}
