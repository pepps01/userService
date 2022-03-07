<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\VerifyCodeRequest;
use Illuminate\Support\Facades\Notification;
use App\Notifications\VerificationCodeNotification;
use App\Models\VerificationCode;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Access\AuthorizationException;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

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

    public static function sendVerificationCode( $email )
    {
        $code = random_int(1000, 9999);
        $checkExistingCodes = VerificationCode::where( 'verifiable',  $email )->get();

        if( $checkExistingCodes ){

            foreach( $checkExistingCodes as $existingCodes ){
                $codes = VerificationCode::find( $existingCodes->id );
                $codes->delete();
            }

        }

        $hashedCode = Hash::make( $code );
        $data = [
            'code' => $hashedCode,
            'verifiable' => $email,
            'expires_at' => Carbon::now()->addMinutes(5)->toDateTimeString()
        ];

        VerificationCode::create( $data );

        $mail = [
            'subject' => 'Verify Email Address',
            'code' => $code,
        ];

        Notification::route('mail', $email )->notify( (new VerificationCodeNotification( $mail )) );
    }

    public function verifyCode(VerifyCodeRequest $request)
    {
        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();
        $verifyUser = $this::verify($data['code'], $data['email']);
        $code = VerificationCode::where( 'verifiable', $data['email'] )->first();

        if ( $user->hasVerifiedEmail() ) {
            return ApiResponse::successResponse('Email already verified', 200);
        }

        if( !$user ){
            return ApiResponse::errorResponse('Invalid details!', 404);
        }

        if( ! $verifyUser ){
            return ApiResponse::errorResponse('Invalid code!', 403);
        }

        if( $code->expires_at < now() ){
            return ApiResponse::errorResponse('Invalid code!', 403);
        }

        $user->email_verified_at = now();
        $user->save();

        $this::delete( $data['email'] );

        return ApiResponse::successResponse('Verification successful', 200);

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

            $this::sendVerificationCode( $request->email );

            if ($request->wantsJson()) {
                return ApiResponse::successResponse('Verification code sent', 200);
            }

        } else {
                return ApiResponse::errorResponse('Invalid details!', 404);
        }


    }

    public static function verify( $code, $email ){
        $getCode = VerificationCode::where( 'verifiable', $email )->first();
        if( $getCode ){
            $existingCode = $getCode->code;
            $correctCode = Hash::check( $code, $existingCode );
           if( $correctCode ){
               return true;
           } else{
            return false;
           }
        } else{
            return false;
        }
    }

    public static function delete( $email )
    {
        $code = VerificationCode::where( 'verifiable', $email )->first();
        if( $code ){
            $code->delete();
        }
    }

}
