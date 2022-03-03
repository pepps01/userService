<?php

namespace App\Repositories;
use App\Models\Doctor;

class DoctorRepository implements RepositoryInterfaces\DoctorRepositoryInterface
{

    public function update(int $id, array $data)
    {
        $doctor = Doctor::where('user_id', $id)->first();
        $doctor->update($data);
        return $doctor;
    }

}
