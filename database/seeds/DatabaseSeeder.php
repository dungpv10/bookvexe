<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        Model::unguard();

        App\Models\BusType::truncate();
        App\Models\Route::truncate();
        App\Models\PointType::truncate();
        App\Models\Role::truncate();
        App\Models\User::truncate();
        App\Models\Setting::truncate();
//        App\Models\Team::truncate();
//        DB::table('team_user')->truncate();

        $this->callSeeder();

        Model::reguard();
        DB::statement("SET foreign_key_checks=1");
    }

    private function callSeeder()
    {
        $seeders = [
            AgentTableSeeder::class,
            RolesTableSeeder::class,
            UserTableSeeder::class,
            BusTypeTableSeeder::class,
            PointTypeTableSeeder::class,
            SettingTableSeeder::class,
            BookingTableSeeder::class
        ];

        foreach ($seeders as $seeder) {
            $this->call($seeder);
        }
    }
}
