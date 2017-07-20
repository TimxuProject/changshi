<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;

Route::rule('borrow/:bid','bs/BookController/borrow');
Route::rule('return/:rid','bs/BookController/returnAction');
Route::rule('detail/:bid','bs/BookController/detail');
Route::rule('remove/:bid','bs/BookController/remove');
Route::rule('delete/:bid','bs/BookController/delete');
