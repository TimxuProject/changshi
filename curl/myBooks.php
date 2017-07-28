<?php
/**
 * Created by PhpStorm.
 * User: i-shichang
 * Date: 2017/7/25
 * Time: 16:12
 */

include 'main.php';
cookieCheck();





$uid = tokenCheck($_COOKIE['userToken'])[1];
$record = new RecordCurlControl();
$res = $record->getCurl(3,123);

echo '已借阅书单<br><br>';

if($res==null){
    echo '您当前尚未借书';
}
else{
    foreach($res['data'] as $row){
        echo $row['bookName']."-";
        echo $row['bid']."-";
        echo $row['rid'];

        echo "<a href='return.php?bid=".$row['bid']."'>".'归还'."</a><br>";
    }
}

echo "<br><a href='Menu.php'>".'返回主页'."</a>";