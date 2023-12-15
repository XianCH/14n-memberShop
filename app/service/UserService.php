<?php

namespace app\service;

use app\common\JwtUtils;
use think\facade\Cache;
use app\model\User as UserModel;

//todo: redis中缺少用户的member信息
class UserService {

     function UserRegister($registerData)
    {
        try {
            $username = $registerData->username;
            $password = $registerData->password;
            $email = $registerData->email;
            $hashedPassword = hash('sha256', $password);
    
            $existingUser = UserModel::where("name", $username)->find();
            if ($existingUser) {
                return json(['error' => 'User already exists'], 500);
            }
            
            //生成uuid
            $uuid = uniqid('prefix-', true);
            $user = new UserModel([
                "uuid" => $uuid,
                "name" => $username,
                "passwd" => $hashedPassword,
                "email" => $email
            ]);
            $res = $user->save();
            if (!$res) {
                return json(['error' => 'SQL operation failed'], 500);
            }
            // 生成jwt
            // 设置redis
            $userData = [
                'name' => $username,
                'member'=>'level_1',
                'email' => $email, 
            ];
            Cache::set('user_' . $uuid, $userData, 3600); 
            $jwt = JwtUtils::genToken($uuid);
            return json(['message'=> 'success','token'=>$jwt,200]);
        } catch (\think\Exception $e) {
            // 捕获 ThinkPHP 数据库操作相关的异常
            return json(['error' => 'Database error: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return json(['error' => 'Unexpected error: ' . $e->getMessage()], 500);
        }
    }
    
    public function LoginService($LoginData)
    {   
        try {
            $username = $LoginData->username;
            $userpasswd = $LoginData->password;

            $user = UserModel::where('name', $username)->find();
            if (!$user) {
                return json(['error' => 'User does not exist'], 404);
            }

            $hashedPassword = hash('sha256', $userpasswd);
            if ($hashedPassword !== $user->passwd) {
                return json(['error' => 'Password is incorrect'], 401);
            }
            $uuid = $user->uuid;
            $token = Cache::get('user_' . $uuid);

            if (!$token) {
                $jwt = JwtUtils::genToken($uuid);
                Cache::set('user_' . $uuid, $jwt, 3600); 
                return json(['token'=>$jwt]);
            } else {
                $jwt = $token;
                Cache::set('user_token_' . $uuid, $jwt, 3600); 
            }
            return json(['message' => 'Login successful', 'token' => $jwt], 200);
        } catch (\think\Exception $e) {
            return json(['error' => 'Database error: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return json(['error' => 'Unexpected error: ' . $e->getMessage()], 500);
        }
    }
    
}