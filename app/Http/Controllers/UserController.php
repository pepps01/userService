<?php

namespace App\Http\Controllers;
use App\Http\Resources\UserResource;
use App\Repositories\RepositoryInterfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponse;

class UserController extends Controller
{
    private $userRepository;
    public function __construct(UserRepositoryInterface $userRepository
    ){
        $this->userRepository = $userRepository;
    }

    public function getUsersByRole( int $roleId )
    {
        $users = $this->userRepository->getUsersByRole( $roleId );

        return ApiResponse::successResponseWithData(UserResource::collection($users), 'Users retrieved successfully', 200);
    }

    public function validateUser()
    {
        $user = Auth::user();

        if( $user ){
            return ApiResponse::successResponseWithData(new UserResource($user), 'Authenticated', 200);
        } else{
            ApiResponse::errorResponse('Invalid User', 403);
        }

    }

    public function getUserById( $id )
    {
        $user = $this->userRepository->getById( $id );
        return ApiResponse::successResponseWithData(new UserResource($user), 'User retrieved', 200);
    }
}
