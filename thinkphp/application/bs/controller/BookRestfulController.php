<?php

namespace app\bs\controller;
use think\Request;
use think\controller\Rest;
include 'code.php';
class BookRestfulController extends Rest
{
    private $data = array('msg'=>'success',
                        'returnCode'=>0);

    public function index()
    {
        switch ($this->method){

            case 'get':
              return $this->read();

            case 'put':
                return $this->update();

            case 'post':
                return $this->save();

            case 'delete':
                return $this->delete();
        }
    }

    public function read(){
        $token = input('get.token');
        if($token== false){
            $this->data['msg'] = 'No permission';
            $this->data['returnCode'] = 5;
        }

        else{
        $flag = input('get.flag');
        if($flag == 1){
            $book = model('Book')->select();
            $this->data['data'] = $book;
        }

        elseif($flag==2){
            $bid = input('get.bid');
            $book = model('Book')->where('bid',$bid)->find();
            if($book == null){
                $this->data['msg'] = 'no such bid exists';
                $this->data['returnCode'] = 1;
            }
            else{
                $this->data['data'] = $book;
            }
        }
        }
        return json_encode($this->data);
    }

    public function save(){
        $bookName = input()['bookName'];
        $book = model('Book');
        $book->bookName = $bookName;
        $data['msg'] = 'insert success';
        $data['errorCode'] = 0;
        $result = $book->save();
        if(!$result){
            $this->data['msg'] = 'save error';
            $this->data['errorCode'] = 1;
        }
        return json($data);
    }

    public function update(){
        $bid = input()['bid'];
        $token = input()['token'];
        $isOut = input()['isOut'];

        echo $bid."<br>";
        echo $token."<br>";
        echo $isOut."<br>";
        if($token==null){
            $holderId = null;
        }

        else {
//            $string = decode($token);
//            echo $string;
            $tokenArray = tokenCheck($token);
            if ($tokenArray!=false) {
                print_r($tokenArray);
                $holderId = $tokenArray[1];
                $book = model('Book')->where('bid',$bid)->find();
                if($isOut == 0){
                    $book->holderId = 0;
                }
                else{
                    $book->holderId = $holderId;
                }

                $book->isOut = $isOut;
                $result = $book->save();

                if(!$result){
                    $this->data['msg'] = 'update error';
                    $this->data['returnCode'] = 1;
                }
            }
            else{
                echo "fail the test";
            }
        }

        return json($this->data);
    }

    public function delete(){
        $bid = input()['bid'];
        $result =  model('Book')->where('bid',$bid)->delete();

        if(!$result){
            $this->data['msg'] = 'delete error';
            $this->data['returnCode'] = 1;
        }
        return json($this->data);
    }
}