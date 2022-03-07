<?php

namespace App\Http\Controllers\Auth;
use App\Repositories\RepositoryInterfaces\UserRepositoryInterface;
use App\Repositories\RepositoryInterfaces\ProfileRepositoryInterface;
use App\Repositories\RepositoryInterfaces\WalletRepositoryInterface;
use App\Http\Requests\CreateUserRequest;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class AuthController extends Controller
{

    private $userRepository;
    private $profileRepository;
    private $walletRepository;
    public function __construct(UserRepositoryInterface $userRepository,
                                ProfileRepositoryInterface $profileRepository,
                                WalletRepositoryInterface $walletRepository
    ){
        $this->userRepository = $userRepository;
        $this->profileRepository = $profileRepository;
        $this->walletRepository = $walletRepository;
        $this->verificationController = new VerificationController();
    }

    /**
     * Login User
     */

    public function login(Request $request)
    {

        $userData =  $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string']
        ]);

        if (Auth::attempt($userData)) {
            $accessToken = Auth::user()->createToken('Auth Token')->accessToken;
            $data = new UserResource(auth()->user());

            return ApiResponse::successResponseWithData($data, 'Login successful', 200, $accessToken);
        }

        return ApiResponse::errorResponse('Invalid Login credentials', 400);
    }

     /**
     * Register user
     */

    public function register(CreateUserRequest $request)
    {

        $newUser = $request->validated();

        $createUser = $this->userRepository->create($newUser);
        $createUserProfile = $this->profileRepository->create($createUser->id, $createUser->role_id);
        $createWallet = $this->walletRepository->create($createUser->id);

        $accessToken = $createUser->createToken('Auth Token')->accessToken;

        $mobileApps = ['rigourPatient', 'rigourDriver', 'rigourDistributor'];
        $webApps = ['polaris', 'ecommerce', 'picon'];

        if ( in_array( $newUser['application_name'], $mobileApps ) ){
            VerificationController::sendVerificationCode( $newUser['email'] );
        }

        if ( in_array( $newUser['application_name'], $webApps ) ){
            event(new Registered( $createUser ));
        }

        $data = new UserResource($createUser);

        return ApiResponse::successResponseWithData($data, 'Registration successful', 200, $accessToken);

    }
}
