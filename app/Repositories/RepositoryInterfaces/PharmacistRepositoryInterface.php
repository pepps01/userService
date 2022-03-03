<?php

namespace App\Repositories\RepositoryInterfaces;

interface PharmacistRepositoryInterface
{
    public function update(int $id, array $data);
    public function getNearbyPharmacists( array $data );
}
