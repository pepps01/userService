<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WalletResource extends JsonResource
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
            'walletId' => $this->id,
            'userId' => $this->user_id,
            'balance' => $this->balance,
            'status' => $this->is_active,
        ];
    }
}
