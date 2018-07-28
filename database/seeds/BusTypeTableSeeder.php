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
        $this->makeBusType();

        $this->makeBuses();

        \App\Models\Bus::chunk(3, function($buses){
            foreach($buses as $bus){
                $bus->routes()->saveMany(factory(\App\Models\Route::class, 2)->make());
                $bus->images()->saveMany(factory(\App\Models\BusImage::class, 2)->make());
                $bus->seatLayout()->save(factory(\App\Models\SeatLayout::class)->make());
                $bus->rates()->saveMany(factory(\App\Models\Rate::class, 2)->make());

                $bus->customers()->saveMany(factory(\App\Models\Customer::class, 30)->make());
            }
        });

    }



    private function makeBuses(){
        \App\Models\BusType::all()->each(function ($busType) {
            $busType->buses()->saveMany(
                factory(\App\Models\Bus::class, 5)->make()
            );

        });
    }


    private function makeBusType(){
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
    }
}
