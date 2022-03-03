<?php

namespace App\Repositories;
use App\Models\Wallet;

class WalletRepository implements RepositoryInterfaces\WalletRepositoryInterface
{

    public function create(int $userId)
    {
        $wallet = Wallet::create(['user_id' => $userId]);
        return $wallet;
    }

    public function update(int $id, array $data)
    {
        $wallet = Wallet::findOrFail($id);
        $wallet->update($data);
        return $wallet;
    }

}
