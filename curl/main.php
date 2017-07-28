<?php
/**
 * Created by PhpStorm.
 * User: i-shichang
 * Date: 2017/7/24
 * Time: 17:57
 */


include 'BookCurlControl.php';
include 'RecordCurlControl.php';
include 'UserCurlControl.php';
include 'code.php';

//$time = Time() + 60*60*2;
//$userName='charles';
//$uid=123;
//$uType=1;
//
//$string = $userName.','.$uid.','.$uType.','.$time;
//$token = encode($string);
//$result = decode($token);

//echo $token;
//echo $result;
function borrow($token,$bid){

    $recordController = new RecordCurlControl();
    $result = $recordController->postRecord($token,$bid);

    if($result['returnCode']==0){
        $bookController = new BookCurlControl();
        $bookController->putCurl($bid,1,$token);
    }
}


function returnBook($token,$bid){

    $recordController = new RecordCurlControl();
    $result = $recordController->putRecord($token,$bid);

    if($result['returnCode']==0){
        $bookController = new BookCurlControl();
        $bookController->putCurl($bid,0,$token);
    }
}

function addUser($userName,$name,$passWord,$gender){
    $userController = new UserCurlControl();
    $passWord = md5($passWord);
    $result = $userController->postCurl($userName,$name,$passWord,$gender);

    if($result==0){
        return true;
    }
    else{
        return false;
    }
}

function checkDouble($userName){
    $userController = new UserCurlControl();
    $result = $userController->getCurl(1);
    foreach($result['data'] as $row){
        if(strcmp($userName,$row['userName'])==0){
            return false;
        }
    }
    return true;
}

function login($userName,$passWord){
    $userController = new UserCurlControl();
    $result = $userController->getCurl(3,'',$userName,$passWord);
    if($result['returnCode']==0){
        return urldecode($result['token']);
    }
    else{
        return false;
    }
    return false;
}

function cookieCheck(){
    $token = $_COOKIE['userToken'];
    $result = tokenCheck($token);
 if($result == false){
     header('Location:login.php');
 }
    else{
        return true;
    }
}

//$result = addUser('charlesTestName','charles','passWord',1);
//if($result){
//    echo 'success';
//}
//else{
//    echo 'fail';
//}

//borrow($token,55);
//returnBook($token,55);