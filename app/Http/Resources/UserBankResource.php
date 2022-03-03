<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserBankResource extends JsonResource
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
            'userBankId' => $this->id,
            'userId' => $this->user_id,
            'accountName' => $this->account_name,
            'accountNumber' => $this->account_number,
            'bank' => new BankResource($this->bank),
            'status' => $this->is_active,
        ];
    }
}
