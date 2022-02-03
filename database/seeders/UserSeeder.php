<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        User::factory(100)->create();
        User::insert([
            'name' => 'saiponethaaung@gmail.com',
            'email' => 'saiponethaaung@gmail.com',
            'email_verified_at' => '2022-02-03 07:17:35',
            'password' => bcrypt('admin123'),
            'remember_token' => 'OlcWL9vICo'
        ]);
    }
}
