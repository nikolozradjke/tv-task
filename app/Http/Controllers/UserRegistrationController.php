<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRegistrationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UserRegisterRequest $request)
    {
        if(
            !User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ])
        ){
            $this->error('Something went wrong', 500);
        }

        $this->response_data['message'] = 'Success';

        return $this->getResponseData();
    }
}
