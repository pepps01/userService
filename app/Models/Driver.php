<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone_number',
        'status',
        'photo',
        'national_id',
        'driver_license',
        'plate_number',
        'ambulance_type',
        'ambulance_service_name',
        'car_model',
        'car_name',
        'address',
        'latitude',
        'longitude',
        'country_id',
        'state_id',
        'is_profile_verified'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function distance(){
        return '100km';
    }

    protected $appends = ['isActive'];

    public function getisActiveAttribute(){

        if($this->status == 1){
            return 'active';
        }

        return 'inactive';
    }
}
