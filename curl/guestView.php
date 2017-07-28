<?php
/**
 * Created by PhpStorm.
 * User: i-shichang
 * Date: 2017/7/4 0004
 * Time: 下午 5:16
 */

include 'main.php';
cookieCheck();
$bookController = new BookCurlControl();
$token   = urlencode($_COOKIE['userToken']);
$result=$bookController->getBook(1,'',$token);

echo '浏览图书界面<br><br>';
foreach($result['data'] as $row){
    if($row['isOut']==0) {
        echo $row['bookName'] . " ";
        echo "<a href='detailGuest.php?bid=" . $row['bid'] . "&bookName=" . $row['bookName'] . "'>" . ' 详细    ' . "</a> ";
        echo "&nbsp;&nbsp;";

        echo "<a href='borrow.php?bid=".$row['bid']."&bookName=".$row['bookName']."'>" . ' 借阅    ' . "</a> ";
        echo "&nbsp;&nbsp;";

        echo "<br>";
    }
}
echo "<br><a href='myBooks.php'>".'点击返回'."</a>";