<?php
/**
 * Created by PhpStorm.
 * User: i-shichang
 * Date: 2017/7/10
 * Time: 16:14
 */


include 'main.php';

if($_POST['login']){
    $userName = $_POST['userName'];
    $passWord = md5($_POST['passWord']);

    $token = login($userName,$passWord);
    if($token == false){
        echo '账号密码不匹配';
    }
    else{
        setcookie('userToken',$token);
//        echo '<br>';
//        echo $token;
//        echo '<br>';
//        echo urlencode($token);
//        print_r(decode(urldecode($token)));
        header('Location:Menu.php');
    }
}

?>

<form action = "" name="login" method = "POST">
    用户名：<input type="text" name="userName" placeholder="请输入你的用户名" required><br><br>
    密码：<input type="password" name="passWord" placeholder="请输入你的密码" required><br><br>
    <input type="submit" name='login' value="点击登录">
    <a href="signUp.php">注册新账号</a>
</form>
