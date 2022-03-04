<?php

namespace Database\Seeders;
use App\Models\Specialization;

use Illuminate\Database\Seeder;

class SpecializationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Specialization::create([
            'id' => '1',
            'name' => 'Phycologist',
        ]);

        Specialization::create([
            'id' => '2',
            'name' => 'Gynaecologist',
        ]);

        Specialization::create([
            'id' => '3',
            'name' => 'Pharmacologist',
        ]);

        Specialization::create([
            'id' => '4',
            'name' => 'Radiologist',
        ]);

        Specialization::create([
            'id' => '5',
            'name' => 'Cardiologist',
        ]);

    }
}
