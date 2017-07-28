<?php
/**
 * Created by PhpStorm.
 * User: i-shichang
 * Date: 2017/7/25
 * Time: 16:32
 */
include 'main.php';

if($_POST['signUp']){

    $name = $_POST['name'];
    $userName = $_POST['userName'];
    $passWord = $_POST['passWord'];
    $passCheck = $_POST['passCheck'];
    $gender = $_POST['gender'];
    $rigTime = Time();

    if(strcmp($passWord,$passCheck)!=0){
        echo "两次输入密码不符合。";
    }

    else if(checkDouble($userName)==false){
        echo "用户名已被注册。";
    }
    else{
        if(addUser($userName,$name,$passWord,$gender))
           header("Location:login.php");

        else
            echo "注册失败。";
    }

}
?>

<form action=''  method="POST">
    姓名:<input type="text" name = "name" placeholder="请输入您的姓名" required><br><br>
    用户名:<input type="text" name = "userName" placeholder="请输入您的用户名" required><br><br>
    密码:<input type="password" name = "passWord" placeholder="请输入您的密码" required><br><br>
    确认密码:<input type="password" name = "passCheck" placeholder="请再次输入您的密码" required><br><br>
    性别:<input type="radio" name = "gender" value = "1" required>男<input type = "radio" name = "gender" value = "0">女<br><br>
    <input type="submit" name='signUp' value="点击提交">
</form>
<input type="button" onclick="window.location.href='login.php'" value="返回登录">
