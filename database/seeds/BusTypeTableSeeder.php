<?php

use Illuminate\Database\Seeder;

class BusTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chairs = [
            [
                'bus_type_name' => 'Ghế ngã',
                'status' => 1,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ],
            [
                'bus_type_name' => 'Ghế ngủ',
                'status' => 1,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ],
            [
                'bus_type_name' => 'Coccoro AC ',
                'status' => 1,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ]
        ];

        \App\Models\BusType::insert($chairs);

        \App\Models\BusType::all()->each(function ($busType) {
            $busType->buses()->saveMany(
                factory(\App\Models\Bus::class, 10)->make()
            );


            $amenities = \App\Models\Amenity::pluck('id');
            \App\Models\Bus::all()->each(function($bus) use ($amenities) {
                $bus->routes()->saveMany(factory(\App\Models\Route::class, 4)->make());
                $bus->images()->saveMany(factory(\App\Models\BusImage::class, 4)->make());

                $bus->amenities()->attach($amenities->random());

                $bus->rates()->saveMany(factory(\App\Models\Rate::class, 5)->make());
            });
        });
    }
}