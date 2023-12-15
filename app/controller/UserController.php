<?php

namespace app\controller;
use think\facade\Request;
use app\service\UserService;
use think\Request as req;
class UserController extends BaseController{

    protected $userService;

    // 通过构造函数依赖注入
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * username
     * password
     * email
     * 
     * return token
     */
    function register()
    {
        $json = Request::getContent();
        $registerData = json_decode($json);
        if (empty($registerData->username) || empty($registerData->password)||empty($registerData->email)) {
            return json(['error' => 'register empty'], 409);
        }
        if (json_last_error() !== JSON_ERROR_NONE) {
            return json(['error' => 'JSON ERROR'], 409);
        }

        $msg = $this->userService->UserRegister($registerData);
        return $msg;
    }



    function sendEmailCode(){
        $email = req->param('email');

    }

    function verifyEmailCode(){}

    function restartPassword(){}

    /**
     * loginfunc->username/email
     * password
     * 
     * return token
     */
    function login(){
        $json = Request::getContent();
        $loginData = json_decode($json);
        $msg = $this->userService->LoginService($loginData);
        return $msg;

    }

    function loginByEmail()
    {
        
    }

}