<?php

use App\Models\User;
use App\Services\UserService;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service = app(UserService::class);

        if (!User::where('name', 'admin')->first()) {
            $user = User::create([
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('admin'),
                'dob' => '1990-11-11',
                'avatar' => '/img/authors/default_avatar.png',
                'mobile' => '123123123'
            ]);

            $service->create($user, 'admin', 'admin', false);
        }

        for ($i = 1; $i < 5; $i ++) {
            $user = User::create([
                'name' => 'Agent' . $i,
                'username' => 'username_' . $i,
                'email' => 'agent_' . $i . '@agent.com',
                'password' => bcrypt('agent'),
                'dob' => '1990-11-11',
                'mobile' => '123123123',
                'avatar' => '/img/authors/default_avatar.png',
            ]);

            $service->create($user, 'user', 'agent', false);
        }

        DB::statement('update user_meta set is_active = 1, activation_token=null;');
    }
}
