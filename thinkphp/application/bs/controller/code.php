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
    
    $strLen = strlen($string);

    if($keyLen < $strLen) {
        $key = str_pad($key, $strLen, $key);
    }

    $content='';
    for($i = 0; $i < $strLen; $i++) {
        $content .= chr(ord($string[$i]) ^ ord($key[$i]));
    }
<<<<<<< HEAD
//    return $content;
    $content = urlencode($content);
    $search = array('+','?');
    $replace = array('_','-');
    str_replace($search,$replace,$content);
    return $content;
=======
   return urlencode(base64_encode($content));

>>>>>>> b554e378b235653238e2dba08e0e80062af27bc7
}

function decode($content){
    $key = '[Lvn[o]6e{y=q#82]G.]rDzv.j';
    $keyLen = strlen($key);
<<<<<<< HEAD


    $replace = array('+','?');
    $search = array('_','-');
    str_replace($search,$replace,$content);

    $content = urldecode($content);
=======
    $content = base64_decode(urldecode($content));
   
>>>>>>> b554e378b235653238e2dba08e0e80062af27bc7
    $strLen = strLen($content);
    if($keyLen < $strLen) {
        $key = str_pad($key, $strLen, $key);
    }
    $string = '';
    for($i = 0; $i < $strLen; $i++) {
        $string .= chr(ord($content[$i]) ^ ord($key[$i]));
    } 
    return $string;
}

function tokenCheck($token){

    if($token == null){
        echo'null';
        return false;
    }
    $string = decode($token);
  
    $array = explode(',',$string);

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