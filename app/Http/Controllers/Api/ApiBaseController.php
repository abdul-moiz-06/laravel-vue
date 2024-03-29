<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiBaseController extends Controller
{
    protected function sendSuccessResponse($data = [], $message = '')
    {
        return response()->json([
            'status' => 'OK',
            'message' => $message,
            'data' => $data
        ]);
    }

    protected function sendErrorResponse($error = '', $data = [], $message = '')
    {
        return response()->json([
            'status' => 'OK',
            'error' => $error,
            'message' => $message,
            'data' => $data
        ]);
    }
}
