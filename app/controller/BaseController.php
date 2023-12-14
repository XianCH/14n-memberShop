<?php

namespace app\controller;
use think\Response;
use think\Validate;


class BaseController {
    
    protected function success($message = 'success',$code = 200,$data =[])
    {
        return $this->jsonResponse($data,$message,$code);
    }

    protected function error($message = 'error' ,$code = 400,$data = [])
    {
        return $this->jsonResponse($data,$message,$code);
    }


    private function jsonResponse($data,$message,$code)
    {
        $responseData = [
            'code' => $code,
            'message' => $message,
            'data'=>$data,
        ];
        return Response::create($responseData,'json',$code);
    }

    protected $rule = [
        'name'  =>  'require|max:25',
        'email' =>  'email',
    ];
}