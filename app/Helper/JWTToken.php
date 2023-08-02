<?php

namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken
{


    public static function CreateToken($userEmail, $userID)
    {
        $key = env('JWT_KEY');
        $payload = [
            'iss' => 'laravel-token',
            'iat' => time(),
            'exp' => time() + 60 * 60,
            'userEmail' => $userEmail,
            'userID' => $userID
        ];

        $jwt = JWT::encode($payload, $key, 'HS256');
        return $jwt;

        //$decoded = JWT::decode($jwt, new Key($key, 'HS256'));

    }
    public static function CreateTokenForSetPassword($userEmail)
    {
        $key = env('JWT_KEY');
        $payload = [
            'iss' => 'laravel-token',
            'iat' => time(),
            'exp' => time() + 60 * 60,
            'userEmail' => $userEmail,
        ];

        return $jwt_token = JWT::encode($payload, $key, 'HS256');

        // $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
        // return $decoded;
    }
    public static function VerifyToken($token)
    {
        try {
            $key = env('JWT_KEY');
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            return $decoded->userEmail;
        } catch (Exception $e) {
            return 'unauthorised';
        }
    }
}
