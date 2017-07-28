<?php
/**
 * Created by PhpStorm.
 * User: i-shichang
 * Date: 2017/7/24
 * Time: 16:46
 */

namespace app\bs\controller;
use think\Request;
use think\controller\Rest;

include 'code.php';

class RecordRestfulController extends REST {

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
        else {

            $flag = input('get.flag');

            if($flag == 1){
                $record = model('Record')->select();
            }

        else if($flag == 2){
            $rid = input('get.rid');
            $record = model('Record')->where('rid',$rid)->find();
            if($record == null){
                $this->data['msg'] = 'no such rid exists';
                $this->data['returnCode'] = 2;
            }
        }
        elseif($flag == 3){
            $uid = input('get.uid');
            $conditions = ['uid'=>$uid,'isBack'=>0];
            $record = model('Record')->where($conditions)->select();
            if($record == null){
                $this->data['msg'] = 'no such uid exists';
                $this->data['returnCode'] = 3;
            }
        }
            $this->data['data'] = $record;
            return json_encode($this->data);
    }
    }

    public function update(){

        $flag = input()['flag'];
        $bid = input()['bid'];
        $token = input()['token'];
        if($token!=null){
            $tokenArray = tokenCheck($token);
            $uid = $tokenArray[1];
        }

        if($flag == 1){
            $isBack = 0;
        }
        else{
            $isBack = 1;
        }

        $returnTime = Time();

        $conditions = [
            'bid'=>$bid,
            'uid'=>$uid,
            'isBack'=> 0
            ];

        $record = model('Record')->where($conditions)->find();

        if($record!=null) {
            $record->returnTime = $returnTime;
            $record->isBack = $isBack;
            $result = $record->save();

        if(!$result){
            $this->data['msg'] = 'update error';
            $this->data['returnCode'] = 1;
        }
        }
        else{
                $this->data['msg'] = 'no such record exists';
                $this->data['returnCode'] = 2;
        }
        return json($this->data);
    }

    public function save(){

        $bid = input()['bid'];
        $token = input()['token'];
        $array = tokenCheck($token);
        $this->data['arr'] = $array;
        if($array==false){
            $this->data['msg'] = '操作未完成，您的登录已超时';
            $this->data['errorCode'] = 2;
        }

//        $array = explode(',',$result);

        $book = model('Book')->where('bid',$bid)->find();
        $userName = $array[0];
        $uid = $array[1];
        $record = model('Record');

        $record->bookName = $book->bookName;
        $record->bid = $bid;
        $record->userName = $userName;
        $record->uid = $uid;

        $result = $record->save();

        if(!$result){
            $this->data['msg'] = 'save error';
            $this->data['errorCode'] = 1;
        }
        return json($this->data);
    }
} 