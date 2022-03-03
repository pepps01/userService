<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateNearMeRequest;
use App\Models\User;
use App\Http\Requests\CreateUpdatePharmacistRequest;
use App\Http\Resources\NearByPharmacistResource;
use App\Http\Resources\UserResource;
use App\Repositories\RepositoryInterfaces\PharmacistRepositoryInterface;
use App\Repositories\RepositoryInterfaces\UserRepositoryInterface;
use App\Traits\ApiResponse;
use App\Models\Pharmacist;

class PharmacistController extends Controller
{
    private $pharmacistRepository;
    private $userRepository;
    public function __construct(PharmacistRepositoryInterface $pharmacistRepository,
                                UserRepositoryInterface $userRepository
                                ){
        $this->pharmacistRepository = $pharmacistRepository;
        $this->userRepository = $userRepository;
        $this->pharmacist = new Pharmacist();
    }

    public function index()
    {

    }

    public function update(CreateUpdatePharmacistRequest $request)
    {
        $userID = auth()->user()->id;
        $getPharmacistToUpdate = User::find($userID);
        $userData = $request->validated();
        if( $getPharmacistToUpdate ){
            $getUserRole = $getPharmacistToUpdate->role_id;
            if( $getUserRole == 72 ){
                $updateUser = $this->userRepository->update( $userID,  $userData );
                $updateProfile = $this->pharmacistRepository->update( $userID,  $userData );
                return ApiResponse::successResponseWithData( new UserResource( $updateUser ), 'Profile updated successfully', 200);
            } else{
                return ApiResponse::errorResponse('User must be a pharmacist', 400);
            }
        } else{
            return ApiResponse::errorResponse('User not found', 400);
        }
    }

    public function pharmacistNearme(CreateNearMeRequest $request)
    {
        $locationData = $request->validated();
        $pharmacists = $this->pharmacistRepository->getNearByPharmacists( $locationData );
        return ApiResponse::successResponseWithData( NearByPharmacistResource::collection( $pharmacists ), 'Pharmacists retrieved successfully', 200);
        return $pharmacists;
    }
}
