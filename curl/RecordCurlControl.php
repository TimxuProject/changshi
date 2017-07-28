<?php
/**
 * Created by PhpStorm.
 * User: i-shichang
 * Date: 2017/7/24
 * Time: 17:36
 */

class RecordCurlControl
{
    private $url = "http://localhost/git/changshi_project/index.php/bs/Record_restful_controller";
    private $ch;
    private $timeout = 5;

    public function getCurl($flag,$uid = '',$rid = '')
    {

        $this->config();
        $token = $_COOKIE['userToken'];
        if ($flag == 1) {
            $requestString = "?flag=" . $flag . "&token=" . $token . "";
        } else if ($flag == 2) {
            $requestString = "?flag=" . $flag . "&token=" . $token . "&rid=" . $rid . "";
        } else if ($flag == 3) {
            $requestString = "?flag=" . $flag . "&token=" . $token . "&uid=" . $uid . "";
        }
        curl_setopt($this->ch, CURLOPT_URL, $this->url.$requestString);

        $output = curl_exec($this->ch);
        $result = json_decode($output, true);

        $this->close();
        if ($result['returnCode'] == 0) {
            return $result;
        } else {
            return false;
        }
        $this->close();
    }


    public function postRecord($token,$bid){
        $this->config();
        $requestString = array('token'=>$token,'bid'=>$bid);
        curl_setopt($this->ch, CURLOPT_URL, $this->url);
        curl_setopt($this->ch, CURLOPT_POST,true);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $requestString);
        $result =  $this->giveInfo();

        return $requestString;
    }

    public function putRecord($token,$bid)
    {
        $this->config();
        $requestString = '?bid='.$bid.'&token='.$token.'';
        $data = array('token'=>$token,'bid'=>$bid);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);

        $rs = $this->giveInfo();

        return $rs;
    }


    private function config(){

        $this->ch = curl_init();
//        $headers = array(
//            'Accept: application/json',
//            'Content-Type: application/json',
//        );
        curl_setopt($this->ch, CURLOPT_HTTPGET, 1);
        curl_setopt($this->ch, CURLOPT_HEADER, false);
//        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, (int)$this->timeout);
    }

    private function giveInfo(){
        $output = curl_exec($this->ch);
        $result = json_decode($output,true);

        $this->close();
        return $result;
    }

    private function close(){
        curl_close($this->ch);
    }
}

//$record = new RecordCurlControl();
////$rs = $record->putRecord('%15%08%23%5C%17%2B%0CA%29%3F8N%3CwmE%10%13g%25%3F%3E3Ca%2Bfq',53);
//$str = '%15%08%23%5C%17%2B%0CA%29%3F8N%3CwmE%10%13g%25%3F%3E3Ca%2Bfq';
//$record->postRecord(urldecode($str),53);