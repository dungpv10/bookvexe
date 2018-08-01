<?php

use Illuminate\Database\Seeder;
use App\Services\TeamService;

class TeamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service = app(TeamService::class);
        for ($i=2; $i < 5 ; $i++) {
        	$service->create($i, [
        	    'name' => 'team_agent_' . $i,
                'address' => 'address agent ' . $i,
                'agent_license' => str_random(3). random_int(0, 3000)
            ]);
        }
    }
}
