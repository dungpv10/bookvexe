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
        Model::unguard();

        $this->callSeeder();

        Model::reguard();
    }

    private function callSeeder()
    {
        $seeders = [
            RolesTableSeeder::class,
            UserTableSeeder::class,
            BusTypeTableSeeder::class,
            PointTypeTableSeeder::class,
            SettingTableSeeder::class
        ];

        foreach ($seeders as $seeder) {
            $this->call($seeder);
        }
    }
}
