<?php
/**
 * Created by PhpStorm.
 * User: i-shichang
 * Date: 2017/7/24
 * Time: 11:27
 */

namespace app\bs\controller;
use think\Request;
use think\controller\Rest;
include 'code.php';
class UserRestfulController extends Rest
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
        $flag = input('get.flag');
        if($flag == 1) {
            $user = model('User')->select();
            $this->data['data'] = $user;
        }

        else if ($flag == 2){
            $uid = input('get.uid');
            $user = model('User')->where('uid',$uid)->column('userName');
            if($user == null){
                $this->data['msg'] = 'no such uid exists';
                $this->data['returnCode'] = 1;
            }
            $this->data['data'] = $user;
        }

        else if ($flag == 3){
            $userName = input('get.userName');
            $passWord = input('get.passWord');
            $condition =[
                'userName'=>$userName,
                'passWord'=>$passWord
            ];
            $user = model('User')->where($condition)->find();
            if($user!=null){
                $time = Time()+60*60*2;
                $string = $user->userName.','.$user->uid.','.$user->uType.','.$time;
                $token = encode($string);
                $this->data['token'] = $token;
            }
            else{
                $this->data['msg'] = '用户名密码不匹配';
                $this->data['returnCode'] = 3;
            }
        }
        return json_encode($this->data);
    }

    public function update(){
        $token = $this->decode(input()['token']);
        $array = explode(',',$token);

        $uid = $array[1];

        if(Time()<$array[3]){
            $user = model('User')->where('uid',$uid)->find();
            $user->userName = input()['newName'];
            $result = $user->save();

            if(!$result){
                $this->data['msg'] = 'update error';
                $this->data['returnCode'] = 1;
            }
        }
        else{
            $this->data['msg']='您的登录已超时';
            $this->data['returnCode']='2';
        }
        return json($this->data);
    }

    public function save(){
        $userName = input()['userName'];
        $name = input()['name'];
        $gender = input()['gender'];
        $passWord = input()['passWord'];

        $user = model('User');

        $user->userName = $userName;
        $user->name = $name;
        $user->gender = $gender;
        $user->passWord = $passWord;

        echo $user->userName;
        echo $user->name;
        echo $user->gender;
        echo $user->passWord;


        $result = $user->save();

        if(!$result){
            $this->data['msg'] = 'update error';
            $this->data['returnCode'] = 1;
        }

        return json($this->data);
    }
}