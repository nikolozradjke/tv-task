<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class UserAuthTokenService
{

    public function generateTokens($email, $password)
    {
        $response = Http::post(env('APP_URL') . '/oauth/token', [
            'grant_type'    => 'password',
            'client_id'     => env('PASSPORT_CLIENT_ID'),
            'client_secret' => env('PASSPORT_CLIENT_SECRET'),
            'username'      => $email,
            'password'      => $password,
            'scope'         => '',
        ]);

        return $response;
    }

    public function refreshTheToken($refresh_token)
    {
        $response = Http::post(env('APP_URL') . '/oauth/token', [
            'grant_type'    => 'refresh_token',
            'refresh_token' => $refresh_token,
            'client_id'     => env('PASSPORT_CLIENT_ID'),
            'client_secret' => env('PASSPORT_CLIENT_SECRET'),
            'scope'         => '',
        ]);

        return $response;
    }

    public function generateAccessToken($user)
    {
        return $user->createToken('access token')->accessToken;
    }
}