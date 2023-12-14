<?php

namespace app\common;

use \Firebase\JWT\JWT;
use \Firebase\JWT\ExpiredException;
use \Firebase\JWT\SignatureInvalidException;
use \Firebase\JWT\BeforeValidException;
use \Exception;

class JwtUtils {
    private static $config = [
        'iss' => 'x14n',
        'key' => 'x14n_key',
        'exp' => 7200,
        'isadmin' => false, // 假设这是一个布尔值，您需要根据实际情况进行调整
        'uuid' => '', // 如果 uuid 有默认值，您可以在这里设置
    ];

    // 生成jwt
    public static function genToken($uuid):string{
        $time = time();
        $payload = [
            'iss' => self::$config['iss'], // 签发者 可选
            'iat' => $time, // 签发时间
            'nbf' => $time - 1, // (Not Before)：某个时间点后才能访问
            'exp' => $time + self::$config['exp'], // 过期时间,这里设置2个小时
            'data' => [
                // 自定义信息，不要定义敏感信息
                'userid' => $uuid,
            ]
        ];
        return JWT::encode($payload, self::$config['key'],"HS256");
    }

    //解析jwt
    public static function parseToken($token) {
        try { 
        $info = JWT::decode($token,self::$config['key']); 
        return json($info);
        } catch (SignatureInvalidException $e) {
            return ['valid' => false, 'error' => '签名错误'];
        } catch (BeforeValidException $e) {
            return ['valid' => false, 'error' => 'token失效'];
        } catch (ExpiredException $e) {
            return ['valid' => false, 'error' => 'token已过期'];
        } catch (Exception $e) {
            return ['valid' => false, 'error' => '非法请求'];
        }
    }

    //刷新token
    public function refreshToken(){

    }

    //检查token是否过期
    public function chackToken(){

    }
}