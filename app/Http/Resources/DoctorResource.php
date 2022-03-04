<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'doctorProfileId' => $this->id,
            'userId' => $this->user_id,
            'phoneNumber' => $this->phone_number,
            'photo' => $this->photo,
            'specialization' => new SpecializationResource( $this->specialization ),
            'otherName' => $this->other_name,
            'title' => $this->title,
            'hospital' => $this->hospital,
            'gender' => $this->gender,
            'status' => $this->status,
        ];
    }
}
