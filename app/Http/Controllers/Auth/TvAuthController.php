<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActivateTvAuthCodeRequest;
use App\Http\Requests\PollTvAuthCodeRequest;
use App\Models\TvCode;
use App\Services\UserAuthTokenService;

class TvAuthController extends Controller
{
    public function __construct(TvCode $tvcode, UserAuthTokenService $tokenService)
    {
        $this->response_data['message'] = 'Success';
        $this->model = $tvcode;
        $this->tokenService = $tokenService;
    }

    public function activateCode(ActivateTvAuthCodeRequest $request)
    {
        $currentCodeRaw = $this->model->where('code', $request->code)->first();

        if(!$currentCodeRaw){
            $this->error('Code is incorrect!', 400);
        }

        if(!$currentCodeRaw->update(['active' => true])){
            $this->error('Something went wrong!', 500);
        }

        $this->response_data['user_id'] = $currentCodeRaw->user_id;

        return $this->getResponseData();
    }

    public function pollTheCode(PollTvAuthCodeRequest $request)
    {
        $credentials = $request->only('code', 'user_id');
        $currentCodeRaw = $this->model
                        ->where($credentials)
                        ->where('expires_at', '>', now())
                        ->where('active', true)
                        ->first();
                        
        if(!$currentCodeRaw){
            $this->error('Unauthorized!', 401);
        }

        $user = $currentCodeRaw->user;
        
        $this->response_data['access_token'] = $this->tokenService->generateAccessToken($user);
        $this->response_data['user_data'] = $user;

        return $this->getResponseData();
    }


}
