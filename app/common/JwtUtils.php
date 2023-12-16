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
        'isadmin' => false,
        'uuid' => '', 
    ];

    // 生成jwt
    public static function genToken($uuid):string{
        $time = time();
        $payload = [
            'iss' => self::$config['iss'],
            'iat' => $time,
            'nbf' => $time - 1, 
            'exp' => $time + self::$config['exp'], 
            'data' => [
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