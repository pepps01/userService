<?php

namespace App\Repositories\RepositoryInterfaces;

interface ProfileRepositoryInterface
{
    public function create(int $userId, int $roleId);
}
