<?php

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
        $faker = \Faker\Factory::create();
        $agents = \App\Models\Agent::pluck('id');

        $dataSeeder = [
            'email' => $faker->unique()->safeEmail,
            'username' => $faker->userName,
            'password' => $password = bcrypt('secret'),
            'dob' => $faker->time('Y-m-d'),
            'mobile' => $faker->phoneNumber,
            'gender' => array_rand([USER_GENDER_MALE, USER_GENDER_FEMALE]),
            'status' => USER_STATUS_ACTIVE,
            'avatar' => $faker->imageUrl(200, 200),
            'address' => $faker->address,
            'remember_token' => str_random(10),
        ];


        $users = [];
        $users[] = array_merge($dataSeeder, [
            'email' => 'admin@example.com',
            'username' => 'root',
            'name' => 'Root',
            'role_id' => 1,
            'agent_id' => null
        ]);
        foreach ($agents as $agent) {
            $users[] = array_merge($dataSeeder, [
                'email' => 'agent_' . $agent . '@agent.com',
                'username' => 'user_' . $agent ,
                'name' => 'Quản trị viên ' . $agent,
                'role_id' => 2,
                'agent_id' => $agent
            ]);

            for($i = 1; $i < 10; $i++) {
                $users[] = array_merge($dataSeeder, [
                    'email' => 'staff_' . $i . '_' . $agent . '@gmail.com',
                    'username' => 'admin_' . $i . '_'.$agent,
                    'name' => 'Nhân viên ' . $i . ' ' . $agent,
                    'role_id' => 3,
                    'agent_id' => $agent
                ]);
            }
        }
        for($i = 1; $i < 10; $i++) {
            $users[] = array_merge($dataSeeder, [
                'email' => 'customer_' . $i . '_' . '@gmail.com',
                'username' => 'customer_' . $i . '_',
                'name' => 'Khách hàng ' . $i . ' ',
                'role_id' => 4,
                'agent_id' => null
            ]);
        }
        \App\Models\User::insert($users);

    }
}
