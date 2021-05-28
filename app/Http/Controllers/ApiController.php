<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $headers = ['Content-Type' => 'application/json'];

    public function responseWithData($statusCode, $data, $message)
    {
        $success = $statusCode === 200 ?? false;
        return response()->json(
            [
                'status'    => $success,
                'message'   => $message,
                'data'      => $data 
            ],
            $statusCode,
            $this->headers
        );
    }

    public function responseWithMessage($statusCode, $message)
    {
        $success = $statusCode === 200 ?? false;
        return response()->json(
            [
                'status'    => $success,
                'message'   => $message
            ],
            $statusCode,
            $this->headers
        );
    }
}
