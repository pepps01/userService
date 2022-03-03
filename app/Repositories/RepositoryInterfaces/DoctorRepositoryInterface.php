<?php

namespace App\Repositories\RepositoryInterfaces;

interface DoctorRepositoryInterface
{
    public function update(int $id, array $data);
}
