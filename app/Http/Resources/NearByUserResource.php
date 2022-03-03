<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NearByUserResource extends JsonResource
{

    public function toArray($request)
    {
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
          ];
    }
}
