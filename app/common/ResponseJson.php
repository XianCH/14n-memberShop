<?php

namespace app\common;

class ResponseJson
{
    public static function json($msg, $data = [])
    {
        $response = [
            'code' => 200,
            'msg' => $msg,
            'data' => $data
        ];
        return self::encodeJson($response);
    }

    public static function success($data = [])
    {
        $response = [
            'code' => 200,
            'msg' => 'success',
            'data' => $data
        ];
        header('Content-Type:application/json');
        return json_encode($response);
    }

    public static function errorWithMsg($msg, $code)
    {
        $response = [
            'code' => $code,
            'msg' => $msg,
        ];
    }

    public static function error($code, $msg, $data = [])
    {
        $response = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ];
        header('Content-Type:application/json');
        return json_encode($response);
    }

    private static function encodeJson($response)
    {
        header('Content-Type:application/json');
        return json_encode($response);
    }
}
