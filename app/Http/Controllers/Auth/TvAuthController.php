<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActivateTvAuthCodeRequest;
use App\Http\Requests\PollTvAuthCodeRequest;
use App\Services\UserAuthTokenService;
use App\Repositories\Tvcode\Interfaces\TvCodeRepositoryInterface;

class TvAuthController extends Controller
{
    public function __construct(TvCodeRepositoryInterface $tvCodeRepository, UserAuthTokenService $tokenService)
    {
        $this->response_data['message'] = 'Success';
        $this->tvCodeRepository = $tvCodeRepository;
        $this->tokenService = $tokenService;
    }

    public function activateCode(ActivateTvAuthCodeRequest $request)
    {
        $tvCode = $this->tvCodeRepository->findByCode($request->code);

        if(!$this->tvCodeRepository->activateCode($tvCode)){
            $this->error('Something went wrong!', 500);
        }

        $this->response_data['user_id'] = $tvCode->user_id;

        return $this->getResponseData();
    }

    public function pollTheCode(PollTvAuthCodeRequest $request)
    {
        $credentials = $request->only('code', 'user_id');
        $tvCode = $this->tvCodeRepository->findValidCode($credentials);
                        
        if(!$tvCode){
            $this->error('Unauthorized!', 401);
        }

        $user = $tvCode->user;
        
        $this->response_data['access_token'] = $this->tokenService->generateAccessToken($user);
        $this->response_data['user_data'] = $user;

        $this->tvCodeRepository->deleteCode($tvCode);

        return $this->getResponseData();
    }


}
