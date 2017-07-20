<?php
namespace app\test\controller;

class Test extends \think\Controller
{
    public function index()
    {
         return $this->fetch('test123/test');
    }
	public function test()
    {
       echo 123;
    }
	

}
