<?php

namespace App\Helpers;

/**
 * Format response.
 */
class ResponseFormatter
{
    protected static $response = [
        "status"=>"success",
        "data"=>null,
        "message"=>null
    ];

    public static function success($data = null, $message = null)
    {
        self::$response['message'] = $message;
        self::$response['data'] = $data;
        if (self::$response['message']==null) {
            unset(self::$response['message']);
        }
        if (self::$response['data']==null) {
            unset(self::$response['data']);
        }
        return response()->json(self::$response, 200);
    }

    public static function error($data = null, $message = null, $code = 400)
    {
        self::$response['status'] = 'error';
        self::$response['message'] = $message;
        self::$response['data'] = $data;
        if (self::$response['message']==null) {
            unset(self::$response['message']);
        }
        if (self::$response['data']==null) {
            unset(self::$response['data']);
        }
        return response()->json(self::$response, $code);
    }
}