 <?php
/**
 * Created by PhpStorm.
 * User: i-shichang
 * Date: 2017/7/21
 * Time: 14:52
 */

class BookCurlControl {
    private $url = "http://localhost/git/changshi_project/index.php/bs/Book_restful_controller";
    private $ch;
    private $timeout = 5;

    public function getBook($flag,$bid='',$token){
        $this->config();
        if($flag==1) {
            $requestString = "?flag=".$flag."&token=".$token."";
        }
        else{
            $requestString = "?flag=".$flag."&bid=".$bid."&token=".$token."";
        }
        curl_setopt($this->ch, CURLOPT_URL, $this->url.$requestString);
        $output = curl_exec($this->ch);
        $result = json_decode($output, true);

        if($result['returnCode']==0) {
          return $result;
        }
        else{
            return false;
        }
        $this->close();
    }

    public function postCurl($bookName){
        $this->config();
        $requestString = '&bookName='.$bookName.'';

        curl_setopt($this->ch, CURLOPT_URL, $this->url);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $requestString);
        curl_setopt($this->ch, CURLOPT_POST,true);

        $this->giveInfo();
    }

    public function putCurl($flag, $token, $bid){
        $this->config();
        if($flag==1) {
            $requestString = array('bid' => $bid, 'isOut' => 1, 'token' => $token);
        }
        elseif($flag==2){
            $requestString = array('bid' => $bid, 'isOut' => 0, 'token' => $token);
        }
        else{
            return false;
        }

        curl_setopt($this->ch, CURLOPT_URL, $this->url);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $requestString);

        $result = $this->giveInfo();
//        echo $this->url;
//        echo $requestString;
        return $result;
    }


//$this->config();
//$requestString = array('token'=>$token,'bid'=>$bid);
//curl_setopt($this->ch, CURLOPT_URL, $this->url);
//curl_setopt($this->ch, CURLOPT_POST,true);
//curl_setopt($this->ch, CURLOPT_POSTFIELDS, $requestString);
//$result =  $this->giveInfo();
//
//return $result;
//}

    public function deleteCurl($bid){
        $this->config();
        $requestString = 'bid='.$bid;

        curl_setopt($this->ch, CURLOPT_URL,$this->url.$requestString);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST,"DELETE");
        $this->giveInfo();
    }

    private function config(){
        $this->ch = curl_init();
        $header[] = "text/xml";
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
    }

    private function close(){
        curl_close($this->ch);
    }
}

//$bookC = new BookCurlControl();
////$bookC->putCurl(53,1,'%15%08%23%5C%17%2B%0CA%29%3F8N%3CwmE%10%13g%25%3F%3E3Ca%2Bfq');
//$bookC->postCurl('123456');