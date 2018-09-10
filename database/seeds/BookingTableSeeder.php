<?php

use Illuminate\Database\Seeder;

class BookingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = \App\Models\Customer::pluck('id');
        $buses = \App\Models\Bus::pluck('id');

        $data = [];
        for($i = 0 ; $i < 28; $i++){
            $data[] = [
                'customer_id' => $customers->random(),
                'bus_id' => $buses->random(),
//                'booking_date' => date('Y-m-d'),
                'payment_status' => array_rand([NOT_PAYMENT, PAYMENT_PROCESSING, PAYMENT_SUCCESS, CANCEL_BOOKING], 1),
                'pickup_point' => 'Pickup ' . $i,
                'drop_point' => 'Drop ' . $i,
                'seat_number' => random_int(30, 40),
                'amount' => random_int(300000, 400000),
                'barcode' => (string)random_int(100000000, 900000000),
                'board_time' => date('Y-m-d H:i:s'),
                'drop_time' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }
        \App\Models\Booking::insert($data);
    }
}
