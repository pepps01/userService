<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\VerifyCodeRequest;
use NextApps\VerificationCode\VerificationCode;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Access\AuthorizationException;
use App\Traits\ApiResponse;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    */


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api')->only('resend');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Resend the email verification notification.
     */

    public function resendVerificationEmail(Request $request)
    {
        $data =  $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        $user = User::where('email', $data['email'])->first();
        if( $user ){
            if ($user->hasVerifiedEmail()) {
                return ApiResponse::successResponse('Email already verified', 200);
            }

            $user->sendEmailVerificationNotification();

            if ($request->wantsJson()) {
                return ApiResponse::successResponse('Verification email sent', 200);
            }

        } else {
                return ApiResponse::errorResponse('The supplied email does not exist!', 404);
        }

    }


    /**
     * Mark the authenticated user's email address as verified.
     */
    public function verifyEmail(Request $request)
    {
        auth()->loginUsingId($request->route('id'));

        if ($request->route('id') != $request->user()->getKey()) {
            throw new AuthorizationException;
        }

        if ($request->user()->hasVerifiedEmail()) {
            return ApiResponse::successResponse('Already verified', 200);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return ApiResponse::successResponse('Verification successful', 200);
    }

    public function verifyCode(VerifyCodeRequest $request)
    {
        $data = $request->validated();
        $verifyUser = VerificationCode::verify($data['code'], $data['email']);

        $checkIfUserExists = User::where('email', $data['email'])->first();
        
        if( !$checkIfUserExists ){
            return ApiResponse::errorResponse('Incorrect email!', 404);
        }

        if( $verifyUser == false){
            return ApiResponse::errorResponse('Incorrect code supplied!', 404);
        } else{
            $user = User::where('email', $data['email'])->first();
            $user->email_verified_at = now();
            $user->save();
            return ApiResponse::successResponse('Verification successful', 200);
        }
    }

    public function resendVerifyCode(Request $request)
    {
        $data =  $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        $user = User::where('email', $data['email'])->first();
        if( $user ){
            if ($user->hasVerifiedEmail()) {
                return ApiResponse::successResponse('Email already verified', 200);
            }

            VerificationCode::send($request->email);

            if ($request->wantsJson()) {
                return ApiResponse::successResponse('Verification code sent', 200);
            }

        } else {
                return ApiResponse::errorResponse('The supplied email does not exist!', 404);
        }


    }

}
