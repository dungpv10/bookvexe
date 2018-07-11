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
                'mobile' => '123123123'
            ]);

            $service->create($user, 'admin', 'admin', false);
        }

        for ($i = 1; $i < 50; $i ++) {
            $user = User::create([
                'name' => 'User' . $i,
                'username' => 'username_' . $i,
                'email' => 'user' . $i . '@example.com',
                'password' => bcrypt('user'),
                'dob' => '1990-11-11',
                'mobile' => '123123123'
            ]);

            $service->create($user, 'user', 'member', false);
        }

        for ($i = 1; $i < 50; $i ++) {
            $user = User::create([
                'name' => 'Agent ' . $i,
                'username' => 'agent_' . $i,
                'email' => 'agent' . $i . '@example.com',
                'password' => bcrypt('user'),
                'dob' => '1990-11-11',
                'mobile' => '123123123'
            ]);

            $service->create($user, 'user', 'agent', false);
        }

    }
}
