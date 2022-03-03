<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
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
            'doctorProfileId' => $this->id,
            'userId' => $this->user_id,
            'phoneNumber' => $this->phone_number,
            'photo' => $this->photo,
            'specialiation' => $this->specialization,
            'otherName' => $this->other_name,
            'title' => $this->title,
            'hospital' => $this->hospital,
            'gender' => $this->gender,
            'status' => $this->status,
        ];
    }
}
