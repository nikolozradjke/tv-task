<?php

namespace App\Http\Controllers\TV;

use App\Http\Controllers\Controller;
use App\Models\TvCode;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TvCodeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $code = TvCode::generateUniqueCode();

        if(
            !TvCode::updateOrCreate(
                ['user_id' => $request->user()->id],
                [
                    'code' => $code, 
                    'active' => false,
                    'expires_at' => Carbon::now()->addMinutes(5)
                ]
            )
        ){
            $this->error('Something went wrong!', 500);
        }
        
        $this->response_data['message'] = 'Success';
        $this->response_data['one_time_code'] = $code;

        return $this->getResponseData();
    }
}
