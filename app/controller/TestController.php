<?php
namespace app\controller;

use app\BaseController;

class TestController extends BaseController
{
    public function apiResponse1()
    {
        // $result = [
        //     'error_code' => $errorCode,
        //     'error_msg'  => $errorMsg,
        //     'data'       => $data,
        // ];
        return 'apiResponse1';
    }

    public function hello(){
        return 'login';
    }

}