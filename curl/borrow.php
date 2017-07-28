<?php
/**
 * Created by PhpStorm.
 * User: i-shichang
 * Date: 2017/7/25
 * Time: 16:08
 */
include 'main.php';
cookieCheck();

$bid = $_GET['bid'];
$token = urlencode($_COOKIE['userToken']);

borrow($token,$bid);

echo "<a href='myBooks.php?uid=123'>".'点击查看'."</a>";