<?php

namespace App\Repositories;
use App\Models\Patient;

class PatientRepository implements RepositoryInterfaces\PatientRepositoryInterface
{

    public function update(int $id, array $data)
    {
        $patient = Patient::where('user_id', $id)->first();
        $patient->update($data);
        return $patient;
    }

}
