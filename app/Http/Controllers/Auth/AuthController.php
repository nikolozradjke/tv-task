<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RefreshTokenRequest;
use App\Services\UserAuthTokenService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct(UserAuthTokenService $tokenService)
    {
        $this->response_data['message'] = 'Success';
        $this->tokenService = $tokenService;
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            $this->error('Unauthorized!', 401);
        }

        $tokenData = $this->tokenService->generateTokens($credentials['email'], $credentials['password']);
   
        if(!$tokenData->successful()){
            $this->error('Try again later!', 500);
        }

        $this->response_data['tokens_data'] = $tokenData->json();
        $this->response_data['user_data'] = Auth::user();

        return $this->getResponseData();
    }

    public function refreshToken(RefreshTokenRequest $request)
    {
        $tokenData = $this->tokenService->refreshTheToken($request->refresh_token);

        if(!$tokenData->successful()){
            $this->error('Try again later!', 500);
        }

        $this->response_data['token_data'] = $tokenData->json();

        return $this->getResponseData();
    }

}
