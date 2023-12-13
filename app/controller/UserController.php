<?php
namespace app\controller;

use think\Request;

class UserController
{
    function getHeader(){
        $info = Request::header();
    echo $info['accept'];
    echo $info['accept-encoding'];
    echo $info['user-agent'];

    }
    function getHeaderAgant(){

    }
    

}

