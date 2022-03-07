<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PatientTableSeeder::class);
        $this->call(PharmacistTableSeeder::class);
        $this->call(DriverTableSeeder::class);
        $this->call(DoctorTableSeeder::class);
        $this->call(SpecializationTableSeeder::class);
    }
}
