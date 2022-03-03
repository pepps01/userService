<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NearByDriverResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'user' => new NearByUserResource( $this->user ),
            'profile' => [
                'driverProfileId' => $this->id,
                'userId' => $this->user_id,
                'status' => $this->is_active,
                'ambulanceServiceName' => $this->ambulance_service_name,
                'activeHours' => null,
                'distance' => $this->whenLoaded('distance'),
            ]
        ];
    }
}
