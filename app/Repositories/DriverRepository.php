<?php

namespace App\Repositories;
use App\Models\Driver;

class DriverRepository implements RepositoryInterfaces\DriverRepositoryInterface
{

    public function update(int $id, array $data)
    {
        $driver = Driver::where('user_id', $id)->first();
        $driver->update($data);
        return $driver;
    }

    public function getNearbyDrivers( array $data )
    {
        $driver = Driver::withinDistanceOf($data['longitude'], $data['latitude'], $data['distance'])->get();
        return $driver;
    }

}
