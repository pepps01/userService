<?php

namespace App\Repositories;
use App\Models\Pharmacist;
class PharmacistRepository implements RepositoryInterfaces\PharmacistRepositoryInterface
{

    public function update(int $id, array $data)
    {
        $pharmacist = Pharmacist::where('user_id', $id)->first();
        $pharmacist->update($data);
        return $pharmacist;
    }

    public function getNearbyPharmacists( array $data )
    {
        $pharmacists =  Pharmacist::orderByDistanceFrom($data['latitude'], $data['longitude'], 'desc')->get();
        return $pharmacists;
    }
}
