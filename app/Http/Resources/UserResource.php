<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        if( $this->role_id == 9){
            $profile = new PatientResource($this->profile);
        }

        if( $this->role_id == 18){
            $profile = new ManufacturerResource($this->profile);
        }

        if( $this->role_id == 27){
            $profile = new DistributorResource($this->profile);
        }

        if( $this->role_id == 36){
            $profile = new HospitalResource($this->profile);
        }

        if( $this->role_id == 45){
            $profile = new DriverResource($this->profile);
        }

        if( $this->role_id == 54){
             $profile = new DoctorResource($this->profile);
        }

        if( $this->role_id == 63){
            $profile = new DispatchRiderResource($this->profile);
        }

        if( $this->role_id == 72){
            $profile = new PharmacistResource($this->profile);
        }

        if( $this->role_id == 81){
            $profile = new LoanBankResource($this->profile);
        }

        if( $this->role_id == 90){
            $profile = new AdminResource($this->profile);
        }

        return [
            'userID' => $this->id,
            'email' => $this->email,
            'firstName' => $this->firstname,
            'lastName' => $this->lastname,
            'fullName' => $this->full_name,
            'role' => $this->role,
            'applicationName' => $this->application_name,
            'lastLoggedIn' => $this->last_logged_in,
            'loggedIn' => $this->logged_in,
            'profile' => $profile,
          ];
    }
}
