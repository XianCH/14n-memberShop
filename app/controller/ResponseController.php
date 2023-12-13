<?php

use think\Request;
use think\Response as ThinkResponse; // 引入 Response 类

class YourController {
    private $response;

    public function __construct() {
        // 初始化 Response 对象
        $this->response = new Response();
    }

    public function post(Request $request) { // 使用依赖注入获取 Request 对象
        $token = $request->header('token'); // 使用非静态方式调用 header 方法
        if ($token == 'token') {
            $this->response = new Response(100, 'success', 'good');
            return json($this->response); // 使用助手函数 json 返回 JSON 响应
        }
        return json(new Response(100, 'bask', '>'));
    }
}

class Response {
    public $code;
    public $response;
    public $data;

    public function __construct($code = 0, $response = '', $data = []) {
        $this->code = $code;
        $this->response = $response;
        $this->data = $data;
    }
}
