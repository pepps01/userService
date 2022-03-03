<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Requests\CreateUpdatePatientRequest;
use App\Http\Resources\UserResource;
use App\Repositories\RepositoryInterfaces\PatientRepositoryInterface;
use App\Repositories\RepositoryInterfaces\UserRepositoryInterface;
use App\Traits\ApiResponse;

class PatientController extends Controller
{
    private $patientRepository;
    private $userRepository;
    public function __construct(PatientRepositoryInterface $patientRepository,
                                UserRepositoryInterface $userRepository
                                ){
        $this->patientRepository = $patientRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {

    }

    public function update(CreateUpdatePatientRequest $request)
    {
        $userID = auth()->user()->id;
        $getPatientToUpdate = User::find($userID);
        $userData = $request->validated();
        if( $getPatientToUpdate ){
            $getUserRole = $getPatientToUpdate->role_id;
            if( $getUserRole == 9 ){
                $updateUser = $this->userRepository->update( $userID,  $userData );
                $updateProfile = $this->patientRepository->update( $userID,  $userData );
                return ApiResponse::successResponseWithData( new UserResource( $updateUser ), 'Profile updated successfully', 200);
            } else{
                return ApiResponse::errorResponse('User must be a patient', 400);
            }
        } else{
            return ApiResponse::errorResponse('User not found', 400);
        }
    }
}
