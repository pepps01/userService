<?php

namespace App\Repositories\RepositoryInterfaces;

interface WalletRepositoryInterface
{
    public function create(int $userId);
    public function update(int $id, array $data);
}
