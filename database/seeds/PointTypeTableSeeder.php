<?php

use Illuminate\Database\Seeder;

class PointTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $boardPoint = [
            'point_type_name' => 'Board Point',
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        ];

        $dropPoint = [
            'point_type_name' => 'Drop Point',
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        ];

        \App\Models\PointType::insert([$boardPoint, $dropPoint]);

        $routes = \App\Models\Route::pluck('id');
        \App\Models\PointType::all()->each(function($pointType) use ($routes){
            $pointType->points()->saveMany(factory(\App\Models\Point::class, 5)->make());
        });


    }
}
