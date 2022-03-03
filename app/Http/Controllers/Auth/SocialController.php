<?php

namespace App\Http\Controllers\Auth;
use App\Repositories\RepositoryInterfaces\ProfileRepositoryInterface;
use App\Repositories\RepositoryInterfaces\WalletRepositoryInterface;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\ClientException;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Resources\UserResource;
use App\Traits\ApiResponse;
use App\Models\User;

class SocialController extends Controller
{

    private $profileRepository;
    private $walletRepository;
    public function __construct(ProfileRepositoryInterface $profileRepository,
                                WalletRepositoryInterface $walletRepository
    ){
        $this->profileRepository = $profileRepository;
        $this->walletRepository = $walletRepository;
    }

    /**
     * Redirect the user to the provider authentication page.
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

     /**
     * Obtain the user information from Provider.
     */
    public function handleProviderCallback($provider)
    {

        try {

            $user = Socialite::driver($provider)->stateless()->user();

        } catch (ClientException $exception) {

            return ApiResponse::errorResponse('Invalid credentials provided', 422);

        }

        $existingUser = User::where(['provider' => $provider, 'provider_id' => $user->getId()])->first();
        $nameArray = explode(' ', $user->getName());

        if( !$existingUser ){

            $userCheck = User::where('email', $user->getEmail())->first();

            if( $userCheck ){
                return ApiResponse::errorResponse('Unable to login, Try a different login method.', 422);
            }

            $newUser = User::create([
            'email' => $user->getEmail(),
            'email_verified_at' => now(),
            'firstname' => $nameArray[0],
            'lastname' => $nameArray[1],
            'application_name' => 'rigourPatient',
            'provider' => $provider,
            'provider_id' => $user->getId(),
            'role_id' => 9,
            ]);

            $createUserProfile = $this->profileRepository->create($newUser->id, $newUser->role_id);
            $createWallet = $this->walletRepository->create($newUser->id);

            $data = new UserResource($newUser);
            $accessToken = $newUser->createToken('Auth Token')->accessToken;
            $message = 'Registration successful';

        } else{

            $data = new UserResource($existingUser);
            $accessToken = $existingUser->createToken('Auth Token')->accessToken;
            $message = 'Login successful';
        }

        return ApiResponse::successResponseWithData($data, $message, 200, $accessToken);
    }
}
