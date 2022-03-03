<?php

namespace Database\Seeders;
use App\Models\Role;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'id' => '9',
            'type' => 'Patient',
        ]);

        Role::create([
            'id' => '18',
            'type' => 'Manufacturer',
        ]);

        Role::create([
            'id' => '27',
            'type' => 'Distributor',
        ]);

        Role::create([
            'id' => '36',
            'type' => 'Hospital',
        ]);

        Role::create([
            'id' => '45',
            'type' => 'Driver',
        ]);

        Role::create([
            'id' => '54',
            'type' => 'Doctor',
        ]);

        Role::create([
            'id' => '63',
            'type' => 'Dispatch Rider',
        ]);

        Role::create([
            'id' => '72',
            'type' => 'Pharmacist',
        ]);

        Role::create([
            'id' => '81',
            'type' => 'Loan Bank',
        ]);

        Role::create([
            'id' => '90',
            'type' => 'Admin',
        ]);
    }
}
