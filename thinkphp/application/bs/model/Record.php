<?php
/**
 * Created by PhpStorm.
 * User: i-shichang
 * Date: 2017/7/14
 * Time: 12:06
 */

namespace app\bs\model;
use think\models;


class Record extends \think\Model {
    protected $table = 'bs_records';
//    protected $table = 'bs_users';

    protected $autoWriteTimestamp = true;
    protected $createTime = 'borrowTime';
    protected $updateTime = 'returnTime';

    protected $connection = [
        // 数据库类型
        'type'        => 'mysql',
        // 服务器地址
        'hostname'    => '127.0.0.1',
        // 数据库名
        'database'    => 'bookstore-2',
        // 数据库用户名
        'username'    => 'root',
        // 数据库密码
        'password'    => '',
        // 数据库编码默认采用utf8
        'charset'     => 'utf8',
        // 数据库表前缀
//        'prefix'      => 'bs_',
        // 数据库调试模式
        'debug'       => false,
    ];
} 