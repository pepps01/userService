<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DriverResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'driverProfileId' => $this->id,
            'userId' => $this->user_id,
            'status' => $this->is_active,
            'gender' => $this->gender,
            'longitude' => $this->longitude,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'ambulanceServiceName' => $this->ambulance_service_name,
            'activeHours' => null,
            'distance' => $this->whenLoaded('distance'),
        ];
    }
}
