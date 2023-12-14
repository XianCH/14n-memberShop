<?php

namespace app\controller;

use app\controller\BaseController;
use think\Request;
use think\facade\Request as req;
use think\Validate;
use app\common\JwtUtils;

class TestController extends BaseController{
    public function testHello(){
        return 'welcome!';
    }    


    public function testGetParam(Request $request){
        return $request->param('name');
    }

    public function testJson(Request $request){
           $json = req::getContent();
           $loginData = json_decode($json, true);
           $validate = new Validate([
               'username' => 'require',
               'password' => 'require'
           ]);
           if (!$validate->check($loginData)) {
               return json(['error' => $validate->getError()], 400);
           }
        
           $authResult = true;
           if ($authResult) {
               return json(['message' => 'Login successful'], 200);
           } else {
               return json(['error' => 'Invalid credentials'], 401);
           }
    }

    public function testJsonResponse(){
        // return $this->success();
        return $this->error($mesage = 'token验证失败');
    }

    public function testGenToken(){
        return $this->success('success',200 , JwtUtils::genToken('123131231'));
    }

    public function hello (){
        return 'hello test!';
    }
    

    public function testRequest() {
        // 获取当前请求对象
        $request = request();
    
        // 获取完整URL地址 不带域名
        $url1 = $request->url();
    
        // 获取完整URL地址 包含域名
        $url2 = $request->url(true);
    
        // 获取当前URL（不含QUERY_STRING） 不带域名
        $url3 = $request->baseFile();
    
        // 获取当前URL（不含QUERY_STRING） 包含域名
        $url4 = $request->baseFile(true);
    
        // 获取URL访问根地址 不带域名
        $url5 = $request->root();
    
        // 获取URL访问根地址 包含域名
        $url6 = $request->root(true);

        $url7=req::controller();

    
        // 返回拼接后的字符串
        return $url1 . ' ' . $url2 . ' ' . $url3 . ' ' . $url4 . ' ' . $url5 . ' ' . $url6.'';
    }



    //test exception
    public function testException(){
        throw new \think\exception\ValidateException('Validation failed.');
        
    }

}
