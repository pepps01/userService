<?php

namespace App\Repositories;
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

class ProfileRepository implements RepositoryInterfaces\ProfileRepositoryInterface
{

    public function create(int $userId, int $roleId)
    {
        if( $roleId == 9){
            $profile = Patient::create(['user_id' => $userId]);
        }

        if( $roleId == 18){
            $profile = Manufacturer::create(['user_id' => $userId]);
        }

        if( $roleId == 27){
            $profile = Distributor::create(['user_id' => $userId]);
        }

        if( $roleId == 36){
            $profile = Hospital::create(['user_id' => $userId]);
        }

        if( $roleId == 45){
            $profile = Driver::create(['user_id' => $userId]);
        }

        if( $roleId == 54){
            $profile = Doctor::create(['user_id' => $userId]);
        }

        if( $roleId == 63){
            $profile = DispatchRider::create(['user_id' => $userId]);
        }

        if( $roleId == 72){
            $profile = Pharmacist::create(['user_id' => $userId]);
        }

        if( $roleId == 81){
            $profile = LoanBank::create(['user_id' => $userId]);
        }

        if( $roleId == 90){
            $profile = Admin::create(['user_id' => $userId]);
        }

        return $profile;
    }
}
