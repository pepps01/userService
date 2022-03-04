<?php

namespace Database\Seeders;
use App\Models\Doctor;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class DoctorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('role_id', 54)->get();
        $faker = Faker::create();
        foreach( $users as $user ){
            Doctor::insert([
                'user_id' => $user->id,
                'phone_number' => $faker->ean8(),
                'bio' => $faker->paragraph(1),
                'hospital' => $faker->paragraph(1),
                'other_name' => $faker->paragraph(1),
                'title' => $faker->paragraph(1),
                'address' => $faker->address(),
                'longitude' => $faker->longitude($min = -180, $max = 180),
                'latitude' => $faker->latitude($min = -90, $max = 90),
                'specialization_id' => $faker->numberBetween(1, 150),
                'gender' => $faker->randomElement(['Male', 'Female']),

            ]);
        }
    }
}
