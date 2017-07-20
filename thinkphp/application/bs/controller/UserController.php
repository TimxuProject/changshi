<?php
namespace app\bs\controller;
use think\Session;
use think\Route;

class UserController extends CommonController
{

    public function index(){
        $msg='';
        $this->assign('msg' , $msg);
        return $this->fetch("./signUp");

    }

    public function login(){
        $msg='';
        if(!input('post.login'))
            return $this->fetch('./login');

        if($this->loginCheck()){
            $this->success('登陆成功','menu');
        }
        else{
            $this->error('用户名或密码有误');
        }
    }

    public function loginCheck(){
        $user = model("User");

        $userName = input('post.userName');
        $passWord = md5(input('post.passWord'));

        $conditions=['userName'=>$userName, 'passWord'=>$passWord];
        $result = $user->where($conditions)->find();
        if($result!=null){
            Session::set('uid',$result->uid);
            Session::set('uType',$result->uType);
            Session::set('userName',$result->userName);
            Session::set('list',array());
            return true;
        }

        else{
            return false;
        }
    }

    public function menu(){
        $this->Pcheck();
        $this->assign('userName',Session::get('userName'));
        $this->assign('uid', Session::get('uid'));

        if(Session::get('uType')==1)
            $this->assign('uType',1);

        else
            $this->assign('uType',0);

        return $this->fetch('./menu');
}

    public function signUp()
    {
        $msg='';
        if (!input('post.signUp')) {
            $this->assign('msg', $msg);
            return $this->fetch('./signUp');
        }
            if (!$this->checkDouble()) {
                $msg = "用户名已被注册，请重新注册<br>";

                $this->assign('msg', $msg);
                return $this->fetch("./signUp");
            };

            if (!$this->checkPw()) {
                $msg = "两次输入的密码不一致，请重新输入<br>";
                $this->assign('msg', $msg);
                return $this->fetch("./signUp");
            };

            $user = model("User");

            $user->name = input('post.name');
            $user->userName = input('post.userName');
            $user->passWord = md5(input('post.passWord'));
            $user->gender = input('post.gender');
            $result = $user->save();
            if($result){

                $this->success('注册成功', 'login');
            }
            else{
                $this->error('注册失败');
            }
    }

    public function manageUser(){
        $this->Pcheck();
        $this->Tcheck();
        $users = Model("User")->paginate(10);
        $page= $users->render();

        $this->assign('users',$users);
        $this->assign('page',$page);
        return $this->fetch('./manageUser');
    }

    public function viewBook(){
        $this->Pcheck();
        $books = Model("Book")->where('isOut',0)->paginate(10);
        $page= $books->render();

        $this->assign('books',$books);
        $this->assign('page',$page);
        $this->assign('uType', Session::get('uType'));
        return $this->fetch('./viewBook');
    }

    private function checkDouble()
    {
        $userName= input('post.userName');
        $user = model("User");
        $a = $user -> where('userName',$userName)
            ->find();

        if($a!=null){
            return false;
        }
        else{
            return true;
        }

    }

    private function checkPw(){
        $passWord = request()->post('passWord');
        $passCheck = request()->post('passCheck');
        if(strcmp($passWord,$passCheck)==0){
            return true;
        }
        else{
            return false;
        }
    }

    public function logout(){
        Session::clear();
        return $this->redirect('login');
    }

}
