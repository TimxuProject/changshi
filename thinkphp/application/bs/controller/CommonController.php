<?php
namespace app\bs\controller;
use think\Session;
use think\Route;

class CommonController extends \think\Controller
{
    protected function Pcheck(){
        if(Session::get('uid')==null){
            return $this->error('您尚未登录','login');
        }
    }

    protected function Tcheck(){
        if(Session::get('uid')==1){
            return $this->error("您没有权限访问此页面");
        }
    }

    protected function fileUpload($file){

        if($file == null){
            return null;
        }
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            // 成功上传后 获取上传信息
            // 输出 jpg
            echo $info->getExtension();
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            echo $info->getSaveName();
            // 输出 42a79759f284b767dfcb2a0197904287.jpg
            echo $info->getFilename();
            return ROOT_PATH . 'public' . DS . 'uploads'.DS.$info->getSaveName();
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
            return '';
        }
    }
}
