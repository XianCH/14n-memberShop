<?php

namespace app\controller;

use app\common\ResponseJson;
use app\common\ServiceException;
use think\facade\Request as FacadeRequest;
use app\service\UserService;
use app\service\SystemService;
use app\validate\UserRegister;
use think\validate;

class UserController extends BaseController
{

    protected $userService;
    protected $systemService;

    public function __construct(UserService $userService, SystemService $systemService)
    {
        $this->systemService = $systemService;
        $this->userService = $userService;
    }

    /*
    ** @param email string
    *
    *@return code string
    */
    function sendEmailCode()
    {
        $email = FacadeRequest::param('email');
        if ($email == null) {
            return ResponseJson::errorWithMsg('邮箱为空', 's01');
        }

        $this->systemService->sendEmailCode($email);
        return ResponseJson::success($email);
    }


    /*
    * @param username string
    * @param password string
    * @param email string
    *
    * @return token string 
    */

    public function register()
    {
        //$json = FacadeRequest::getContent();
        //$registerData = json_decode($json, true);  // 注意第二个参数设置为 true，将 JSON 转换为数组
        //$username = FacadeRequest::param('username');
        //$validator = new UserRegister();
        //if (!$validator->check($registerData)) {
        //  return ResponseJson::error($validator->getError());
        //}
        $username = FacadeRequest::param('username');
        $password = FacadeRequest::param('password');
        $email = FacadeRequest::param('email');
        $result = $this->userService->UserRegister($username, $password, $email);
        return ResponseJson::json($result['msg'], $result['data']);
    }
}
/**
 * @param email string
 * @param code string
 *
 * @return result 
 */
function verifyEmailCode()
{
    $email = FacadeRequest::param('email');
    $code  = FacadeRequest::param('code');
    $result = $this->systemService->verifyEmail($email, $code);
    return ResponseJson::json($result);
}

/**
 * @param username string
 * @param password string
 * 
 * return token string
 */
function login()
{
    $json = FacadeRequest::getContent();
    $loginData = json_decode($json);
    $result = $this->userService->LoginService($loginData);
    return ResponseJson::json($result);
}


/**
 * @param uuid string
 * @param password string
 * @param newpassword string
 *
 * return succes or error  
 */
function restartPassword()
{
}

/**
 * @param email
 * @param password string
 *
 * return jwt string
 */
function loginByEmail()
{
}
