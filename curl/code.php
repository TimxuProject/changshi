<?php
/**
 * Created by PhpStorm.
 * User: i-shichang
 * Date: 2017/7/24
 * Time: 10:21
 */

function encode($string){
    $key = '[Lvn[o]6e{y=q#82]G.]rDzv.j';
    $keyLen = strlen($key);
    $string = base64_encode($string);

    $strLen = strlen($string);

    if($keyLen < $strLen) {
        $key = str_pad($key, $strLen, $key);
    }

    $content='';
    for($i = 0; $i < $strLen; $i++) {
        $content .= chr(ord($string[$i]) ^ ord($key[$i]));
    }
//    return $content;
    return urlencode($content);
}

function decode($content){
    $key = '[Lvn[o]6e{y=q#82]G.]rDzv.j';
    $keyLen = strlen($key);

//    $content = urldecode($content);
    $strLen = strLen($content);
    if($keyLen < $strLen) {
        $key = str_pad($key, $strLen, $key);
    }

    $string = '';
    for($i = 0; $i < $strLen; $i++) {
        $string .= chr(ord($content[$i]) ^ ord($key[$i]));
    }
    $string = base64_decode($string);


    return $string;
}

function tokenCheck($token){
    if($token == null){
        echo'null';
        return false;
    }
//    print_r($token);
    $string = decode($token);
//    echo "《".$string.'》';
    $array = explode(',',$string);
//print_r($array);
    if(TIME()>$array[3]){
        echo'超时';
        echo TIME()."   ";
//        echo $array[3];
        return false;
    }
    return $array;
}

//
////echo decode('%02%7F%2C%07%17%2B%04%03%29%3F8N%3CwmE%10%13oo%3C.%19%01%60%0Dfq');
////print_r(tokenCheck('%02%7F%2C%07%17%2B%04%03%29%3F8N%3CwmE%10%13oo%3C.%19%01%60%0Dfq'));
////
////echo decode('%15%08%23%5C%17%2B%0CA%29%3F8N%3CwmE%10%13g%25%3F%3E3Ca%2Bfq')."<br>";
////
// $a = encode('456,40,0,1501213298');
////echo urlencode('%15%08%23%5C%17%2B%0CA%29%3F8N%3CwmE%10%13oo%3C.%3FD%60%3Bfq');
//
//$str = urlencode($_GET['token']);
//
//decode($str);

//echo $a;