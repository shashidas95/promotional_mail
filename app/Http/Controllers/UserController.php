<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use App\Mail\VerificationCodeMail;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function UserRegistration(Request $request)
    {
        try {
            $user = User::create([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'mobile' => $request->input('mobile'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ]);
            return response()->json([
                'status' => 'success',
                'message' => "UserRegistration successful"
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => "userloggin failed"
            ], 401);
        }
    }
    public function UserLogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $count = User::where('email', '=', $email)->where('password', '=', $password)->count();
        if ($count === 1) {
            $token = JWTToken::CreateToken($email, 'id');

            return response()->json([
                'status' => 'success',
                'message' => "userloggin successful",
                'token' => $token
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => "userloggin failed"
            ], 401);
        }
    }


    public function SendOtp(Request $request)
    {
        $email = $request->input('email');
        $otp = rand(1000, 9999);
        $count = User::where('email', '=', $email)->count();
        if ($count === 1) {
            Mail::to($email)->send(new VerificationCodeMail($otp));
            User::where('email', $email)->update(['otp' => $otp]);
            return response()->json([
                'status' => 'success',
                'message' => "OTP sent to your Email successful"
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => "userloggin failed"
            ], 401);
        }
    }
    public function VerifyOtp(Request $request)
    {
        $email = $request->input('email');
        $otp = $request->input('otp');
        $count = User::where('email', '=', $email)->where('otp', '=', $otp)->count();

        if ($count === 1) {
            $token = JWTToken::CreateTokenForSetPassword($email);
            User::where('email', $email)->update(['otp' => '0']);
            return response()->json([
                'status' => 'success',
                'message' => "OTP sent to your Email successful",
                'token' => $token
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => " otp verification failed"
            ], 401);
        }
    }
    public function ResetPassword(Request $request)
    {
        try {
            $email = $request->header('email');
            $password = $request->input('password');
            User::where('email', $email)->update(['password' => $password]);
            return response()->json([
                'status' => 'success',
                'message' => "password reset successful"

            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => "password reset failed"
            ], 401);
        }
    }
}
