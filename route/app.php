<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

//Route::快捷方法名('路由表达式', '路由地址');

use think\facade\Route;

// Route::get('think', function () {
//     return 'hello,ThinkPHP6!';
// });

// Route::get('hello/:name', 'index/hello');

// Route::rule('new/:id','News/read');

// Route::get('index','index');

// Route::get('test', 'ControllerTest/apiResponse');

// Route::get('testJson','index/returnJson');

// Route::resource('blog', 'Blog')
//     ->vars(['blog' => 'blog_id']);
// Route::get('user/get-header', 'UserController@getHeader');


Route::get('hello','HelloWorld/hello');