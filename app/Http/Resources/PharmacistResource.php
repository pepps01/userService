<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PharmacistResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'pharmacistProfileId' => $this->id,
            'userId' => $this->user_id,
            'status' => $this->is_active,
            'gender' => $this->gender,
            'phone' => $this->phone_number,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'phoneNumber' => $this->phone_number
        ];
    }
}
