<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Requests\CreateUpdateDoctorRequest;
use App\Http\Resources\UserResource;
use App\Repositories\RepositoryInterfaces\DoctorRepositoryInterface;
use App\Repositories\RepositoryInterfaces\UserRepositoryInterface;
use App\Traits\ApiResponse;

class DoctorController extends Controller
{
    private $doctorRepository;
    private $userRepository;
    public function __construct(DoctorRepositoryInterface $doctorRepository,
                                UserRepositoryInterface $userRepository
                                ){
        $this->doctorRepository = $doctorRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {

    }

    public function update(CreateUpdateDoctorRequest $request)
    {
        $userID = auth()->user()->id;
        $getDoctorToUpdate = User::find($userID);
        $userData = $request->validated();
        if( $getDoctorToUpdate ){
            $getUserRole = $getDoctorToUpdate->role_id;
            if( $getUserRole == 18 ){
                $updateUser = $this->userRepository->update( $userID,  $userData );
                $updateProfile = $this->doctorRepository->update( $userID,  $userData );
                return ApiResponse::successResponseWithData( new UserResource( $updateUser ), 'Profile updated successfully', 200);
            } else{
                return ApiResponse::errorResponse('User must be a doctor', 403);
            }
        } else{
            return ApiResponse::errorResponse('User not found', 404);
        }
    }
}
