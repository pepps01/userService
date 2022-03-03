<?php

namespace Database\Seeders;
use App\Models\Driver;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class DriverTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::whereBetween('id', array(31, 60))->get();
        $faker = Faker::create();
        foreach( $users as $user ){
            Driver::insert([
                'user_id' => $user->id,
                'phone_number' => $faker->ean8(),
                'address' => $faker->address(),
                'longitude' => $faker->longitude($min = -180, $max = 180),
                'latitude' => $faker->latitude($min = -90, $max = 90),
                'country_id' => $faker->numberBetween(1, 50),
                'state_id' => $faker->numberBetween(1, 150),
            ]);
        }
    }
}
