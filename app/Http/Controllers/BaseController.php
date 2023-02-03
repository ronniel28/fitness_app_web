<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        if (is_array($errorMessages)) {
            if (isset($errorMessages['error'])) {
                $response = [
                    'success' => false,
                    'message' => $errorMessages['error'],
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => $error,
            ];
        }

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
