<?php

namespace app\common;

class ResponseEnty  {
    public $code;
    public $msg;
    public $data;

    function __construct($code,$message,$data)
    {
        $this->msg = $message;
        $this->code = $code;
        $this->data = $data;
    }

    function success(){
        $response = new ResponseEnty('200','success',null);
        return json($response);
    } 
    function successWithDate($data){
        $response = new ResponseEnty('200','success',$data);
        return json($response);
    } 

    function faildWithMsg($msg){
        $response = new ResponseEnty('100',$msg,null);
        return json($response);
    }

    
}