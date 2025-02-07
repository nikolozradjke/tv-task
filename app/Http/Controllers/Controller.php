<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected int $status_code = 200;
    protected array $response_data = [];

    public function getResponseData()
    {
        return response()->json($this->response_data, $this->status_code);
    }

    public function error($message, $code)
    {
        abort(response()->json(
            [
                'message' => $message
            ],
            $code)
        );
    }
}
