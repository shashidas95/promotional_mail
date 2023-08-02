<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\VerificationCodeMail;
use Illuminate\Support\Facades\Mail;

class CodeController extends Controller
{
    public function generateVerificationCodeForUser(User $user)
    {
        try {
            $email = $user->email; // Assuming you have an email property in the User model
            $verificationCode = $user->generateVerificationCode($email);

            // Save the verification code to the user's database record

            // $user->verification_code = $verificationCode;
            // $user->save();

            // Send the verification code to the user's email
            // Mail::to($user->email)->send(new VerificationCodeMail($verificationCode));
            return response()->json([
                'status' => 'success',
                'message' => "sending email successfully",
                "data" => $verificationCode
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => "sending email error"
            ], 401);
        }
    }
}
