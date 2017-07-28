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
returnBook($token,$bid);

echo "<a href='myBooks.php'>".'点击返回'."</a>";