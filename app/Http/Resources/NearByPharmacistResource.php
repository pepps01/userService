<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NearByPharmacistResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'user' => new NearByUserResource( $this->user ),
            'profile' => [
            'pharmacistProfileId' => $this->id,
            'userId' => $this->user_id,
            'status' => $this->is_active,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'phoneNumber' => $this->phone_number
           ]
        ];
    }
}
