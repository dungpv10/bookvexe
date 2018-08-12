<?php

use Illuminate\Database\Seeder;

class AgentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Agent::class, 10)->create()->each(function($agent){
            $agent->promotions()->saveMany(factory(\App\Models\Promotion::class, 5)->make());
        });
    }
}
