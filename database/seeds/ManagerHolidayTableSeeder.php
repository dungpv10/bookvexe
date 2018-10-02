<?php

use Illuminate\Database\Seeder;

class ManagerHolidayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $holidays = [
            [
                'date' => '2/9',
                'increase_price' => 20000
            ]
        ];

        \App\Models\ManagerHoliday::insert($holidays);
    }
}
