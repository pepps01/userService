<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\DispatchRider;
use App\Models\Distributor;
use App\Models\Doctor;
use App\Models\Driver;
use App\Models\Hospital;
use App\Models\LoanBank;
use App\Models\Manufacturer;
use App\Models\Patient;
use App\Models\Pharmacist;
use Faker\Factory as Faker;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = User::all();
        $faker = Faker::create();

        foreach( $users as $user ){
            $roleId = $user->role_id;
            if( $roleId == 9){
                Patient::insert([
                    'user_id' => $user->id,
                ]);
            };

            if( $roleId == 18){
                Manufacturer::insert([
                    'user_id' => $user->id,
                ]);
            };

            if( $roleId == 27){
                Distributor::insert([
                    'user_id' => $user->id,
                ]);
            };

            if( $roleId == 36){
                Hospital::insert([
                    'user_id' => $user->id,
                ]);
            };

            if( $roleId == 45){
                Driver::insert([
                    'user_id' => $user->id,
                ]);
            };

            if( $roleId == 54){
                Doctor::insert([
                    'user_id' => $user->id,
                ]);
            };

            if( $roleId == 63){
                DispatchRider::insert([
                    'user_id' => $user->id,
                ]);
            };

            if( $roleId == 72){
                Pharmacist::insert([
                    'user_id' => $user->id,
                ]);
            };

            if( $roleId == 81){
                LoanBank::insert([
                    'user_id' => $user->id,
                ]);
            };

            if( $roleId == 90){
                Admin::insert([
                    'user_id' => $user->id,
                ]);
            };

        }
    }
}
