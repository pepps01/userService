<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNearMeRequest;
use App\Models\User;
use App\Http\Requests\CreateUpdateDriverRequest;
use App\Http\Resources\DriverResource;
use App\Http\Resources\UserResource;
use App\Repositories\RepositoryInterfaces\DriverRepositoryInterface;
use App\Repositories\RepositoryInterfaces\UserRepositoryInterface;
use App\Traits\ApiResponse;

class DriverController extends Controller
{
    private $driverRepository;
    private $userRepository;
    public function __construct(DriverRepositoryInterface $driverRepository,
                                UserRepositoryInterface $userRepository
                                ){
        $this->driverRepository = $driverRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {

    }

    public function update(CreateUpdateDriverRequest $request)
    {
        $userID = auth()->user()->id;
        $getDriverToUpdate = User::find($userID);
        $userData = $request->validated();
        if( $getDriverToUpdate ){
            $getUserRole = $getDriverToUpdate->role_id;
            if( $getUserRole == 45 ){
                $updateUser = $this->userRepository->update( $userID,  $userData );
                $updateProfile = $this->driverRepository->update( $userID,  $userData );
                return ApiResponse::successResponseWithData( new UserResource( $updateUser ), 'Profile updated successfully', 200);
            } else{
                return ApiResponse::errorResponse('User must be a driver', 403);
            }
        } else{
            return ApiResponse::errorResponse('User not found', 404);
        }
    }

    public function driverNearme(CreateNearMeRequest $request)
    {
        $locationData = $request->validated();
        $drivers = $this->driverRepository->getNearByDrivers( $locationData );
        return ApiResponse::successResponseWithData( DriverResource::collection( $drivers ), 'Drivers retrieved successfully', 200);
    }
}
