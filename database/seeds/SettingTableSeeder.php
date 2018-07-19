<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Setting::create([
            'title' => 'Book vé xe',
            'logo_path' => 'img/logo.png',
            'favicon_path' => 'img/logo.png',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_username' => 'dungpv10@gmail.com',
            'smtp_password' => '323278bhbh9',
            'email' => 'dungpv@bookvexe.com',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book'
        ]);
    }
}
