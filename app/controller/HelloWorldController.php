<?php

namespace app\controller;
use app\BaseController;
use think\facade\Log;


class HelloWorldController extends BaseController
{
    public function hello()
    {
        // 记录信息日志
        Log::info('这是一条信息级别的测试日志');
        
        // 记录错误日志
        Log::error('这是一条错误级别的测试日志');
        
        // 或者使用助手函数
        trace('这是一条使用trace函数的信息级别测试日志', 'info');
        return 'hello，world！';
    }


}