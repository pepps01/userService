<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WalletResource extends JsonResource
{
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
