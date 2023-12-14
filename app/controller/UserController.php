<?php

namespace app\controller;
use think\facade\Request;
use think\Response;
use app\service\User;

class UserController extends BaseController{

    public function register(Request $request)
    {}

    function getEmail(){}

    function verifyEmail(){}

    function restartPassword(){}

    function loginByEmail(){}



    function loginById(){
        $json = Request::getContent();
        $loginData = json_decode($json,true);
        
    }
}