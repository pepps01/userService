<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
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
            'patientProfileId' => $this->id,
            'userId' => $this->user_id,
            'gender' => $this->gender,
            'phone' => $this->phone_number,
            'status' => $this->is_active,
        ];
    }
}
