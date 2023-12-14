<?php

namespace app\middleware;

use think\Request;
use app\BaseController;
use app\common\JwtUtils;

class HttpHandle{

    //运行跨域请求访问 输出访问日志日志
    public function CatcHttpHandler(Request $request,\Closure $next)
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
        header("Access-Control-Max-Age: 86400");

        if ($request->isOptions()) {
            exit;
        }
        $this->logHttpRequest($request);
        return $next($request);
    }

    public function logHttpRequest(Request $request)
    {
        $url = $request->url(true);
        $method = $request->method();
        \think\facade\Log::info("HTTP request: {$method} {$url}");
    }

    public function TokenHandler(Request $request, \Closure $next)
    {
        $token = $request->header('aute');
        if ($token == null) {
            $response = [
                'msg' => 'no token',
                'code' => 401 
            ];
            return json($response, 401); 
        }
        $result = JwtUtils::parseToken($token);
        if (!$result['valid']) {
            return json(['msg' => $result['error'], 'code' => 401], 401);
        }
        return $next($request);
    }
} 