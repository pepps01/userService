<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PharmacistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'pharmacistProfileId' => $this->id,
            'userId' => $this->user_id,
            'status' => $this->is_active,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'phoneNumber' => $this->phone_number
        ];
    }
}
