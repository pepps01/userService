<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'provider',
        'provider_id',
        'application_name',
        'password',
        'role_id',
        'date_of_birth',
        'last_logged_in',
        'logged_in',
        'email_verified_at',
    ];

    protected $dates = [
        'deleted_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'full_name',
        'role',
        'is_verified',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getIsVerifiedAttribute(){

        if( ! empty( $this->email_verified_at ) ){
            return 'verified';
        }
        return 'unverified';
    }

    public function getFullNameAttribute(){
        return $this->firstname.' '.$this->lastname;
    }

    public function getRoleAttribute() {
        $role = Role::where('id', $this->role_id)->first();
        return $role->type;
    }

    public function profile(){
        $roleId = $this->role_id;
        if( $roleId == 9){
            return $this->hasOne(Patient::class);
        }

        if( $roleId == 18){
            return $this->hasOne(Manufacturer::class);
        }

        if( $roleId == 27){
            return $this->hasOne(Distributor::class);
        }

        if( $roleId == 36){
            return $this->hasOne(Hospital::class);
        }

        if( $roleId == 45){
            return $this->hasOne(Driver::class);
        }

        if( $roleId == 54){
             return $this->hasOne(Doctor::class);
        }

        if( $roleId == 63){
            return $this->hasOne(DispatchRider::class);
        }

        if( $roleId == 72){
            return $this->hasOne(Pharmacist::class);
        }

        if( $roleId == 81){
            return $this->hasOne(LoanBank::class);
        }

        if( $roleId == 90){
            return $this->hasOne(Admin::class);
        }
    }
}
