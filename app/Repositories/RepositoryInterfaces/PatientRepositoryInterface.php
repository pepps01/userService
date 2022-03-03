<?php

namespace App\Repositories\RepositoryInterfaces;

interface PatientRepositoryInterface
{
    public function update(int $id, array $data);
}
