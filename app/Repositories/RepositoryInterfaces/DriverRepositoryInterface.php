<?php

namespace App\Repositories\RepositoryInterfaces;

interface DriverRepositoryInterface
{
    public function update(int $id, array $data);
    public function getNearbyDrivers( array $data );
}
