<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => '1',
            'email' => 'veecthorpaul@gmail.com',
            'firstname' => 'John',
            'lastname' => 'Doe',
            'role_id' => '45',
            'email_verified_at' => '2021-11-03',
            'application_name' => 'rigour_patient',
            'password' =>  bcrypt('password'),
        ]);

       User::factory()->count(100)->create();

    }
}
