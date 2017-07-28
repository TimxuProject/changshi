<?php
/**
 * Created by PhpStorm.
 * User: i-shichang
 * Date: 2017/7/24
 * Time: 14:49
 */

class UserCurlControl {
    private $url = "http://localhost/git/changshi_project/index.php/bs/User_restful_controller";
    private $ch;
    private $timeout = 5;

    public function getCurl($flag,$uid='',$userName='',$passWord=''){

        $this->config();
        if($flag == 1){
            $requestString = "?flag=".$flag."";
        }
        else if ($flag == 2){
            $requestString = "?flag=".$flag."&uid=".$uid."";
        }
        elseif ($flag == 3){
            $requestString = "?flag=".$flag."&userName=".$userName."&passWord=".$passWord."";
        }

        curl_setopt($this->ch, CURLOPT_URL, $this->url.$requestString);

    echo  $this->url.$requestString;
        $output = curl_exec($this->ch);
        $result = json_decode($output, true);
        $this->close();
        return $result;
    }

    public function postCurl($userName,$name,$passWord,$gender){
        $this->config();
        $requestString = 'userName='.$userName.'&name='.$name.'&passWord='.$passWord.'&gender='.$gender.'';
//    echo $this->url;
//        echo $requestString;
        curl_setopt($this->ch, CURLOPT_URL, $this->url);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $requestString);
        curl_setopt($this->ch, CURLOPT_POST,true);

        return $this->giveInfo();
    }

    private function config(){
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_HTTPGET, 1);
        curl_setopt($this->ch, CURLOPT_HEADER, false);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, (int)$this->timeout);
    }

    private function giveInfo(){
        $output = curl_exec($this->ch);
        $result = json_decode($output,true);
//        echo $result['msg'];
        $this->close();
        return $result['returnCode'];
    }

    private function close(){
        curl_close($this->ch);
    }
}

//$test = new UserCurlControl();

//$test->getCurl();