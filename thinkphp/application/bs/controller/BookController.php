<?php
/**
 * Created by PhpStorm.
 * User: i-shichang
 * Date: 2017/7/18
 * Time: 10:25
 */
namespace app\bs\controller;
use think\Session;
use think\Route;
use think\File;
use think\Request;

class BookController extends CommonController
{
    public function addBook(){
        $this->Pcheck();
        $this->Tcheck();

        if (!input('post.addBook')) {
            $this->assign('rootPath',ROOT_PATH);
            return $this->fetch('./addBook');
        }

        $book = model("Book");
        $book->bookName = input('post.bookName');
        $book->author = input('post.author');
        $book->publisher = input('post.publisher');
        $book->detail = input('post.detail');
        $book->genre = input('post.genre');

        $coverPath = $this->fileUpload(request()->file('cover'));
        $book->coverPath = $coverPath;

        $result = $book->save();
//        echo  $book->getLastSql();
        if($result){
            $this->success('添加成功','addBook');
        }
        else{
            $this->error('添加失败');
        }
    }

    public function detail($bid){
        $this->Pcheck();
        $book = model('Book')->where('bid',$bid)->find();

        $this->assign('bid',$book->bid);
        $this->assign('bookName',$book->bookName);
        $this->assign('author',$book->author);
        $this->assign('publisher',$book->publisher);
        $this->assign('isOut',$book->isOut);
        $this->assign('genre',$book->genre);
        $this->assign('holderId',$book->holderId);
        $this->assign('detail',$book->detail);
        $this->assign('uType',Session::get('uType'));


        if($book->isOut == 1){
            $holder = model('User')->where('holderId',$book->holderId)->find();
            $this->assign('userName',$holder->userName);
        }
        else{
            $this->assign('userName','在库');
        }
        return $this->fetch('./detail');

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

    public function preBorrow(){
        $this->Pcheck();
        $list = Request::instance()->only('group');

        if(!empty($list)) {
            $Sist = Session::get('list');
            foreach ($list['group'] as $bid) {
                $book = model('Book')->where('bid', $bid)->find();
                $Sist[$bid] = $book->bookName;
            }
            Session::set('list', $Sist);
        }
        $this->assign('list', Session::get('list'));
        return $this->fetch('.\preList');
    }

    public function personalBook(){
        $this->Pcheck();
        $conditions = [
            'uid'=>Session::get('uid'),
            'isBack'=>0];
        $records = Model("Record")->where($conditions)->paginate(10);

        $page= $records->render();

        $this->assign('records',$records);
        $this->assign('page',$page);
        return $this->fetch('./personalBook');
    }

    public function borrow($bid='')
    {
        $this->Pcheck();
        if($bid==0) {
            if($this->checkOut()){
                return $this->success('添加成功', 'preBorrow');
            }
        }
        else{

            $book = Model('book')->where('bid', $bid)->find();
            $list = array();
            $list[$bid] = $book->bookName;
            $this->checkOut($list);
            return $this->success('添加成功', 'preBorrow');

        }
    }
    private function checkOut($list=''){

        if($list==''){
        $list = SESSION::get('list');
        }
        foreach($list as $bookId=>$bookName){
                $this->borrowBook($bookId);
                $this->borrowRecord($bookId);

            $this->remove($bookId,1);
            }
        return $this->success('借阅成功！','personalBook');
        }
    private function borrowBook($bid){
        $book = model('Book');
        $result = $book->where('bid',$bid)->update(['isOut'=>1, 'holderId' => Session::get('userName')]);

        if($result){
            return true;
        }
        else{

            echo $bid."borrowBook false<br>";
            return false;
        }

    }
    private function borrowRecord($bid){
        $book = model("Book")->where('bid',$bid)->find();
        $bookName = $book->bookName;

        $record = model("Record");
        $record -> data([
            'bid'  =>  $bid,
            'uid' =>  Session::get('uid'),
            'userName' =>  Session::get('userName'),
            'bookName' => $bookName
        ]);

        $result = $record->isUpdate(false)->save();

        if ($result){
            return true;
        }
        else {
            return false;
        }
    }


    public function remove($bid,$flag=''){
        $this->Pcheck();
        $list = Session::get('list');
        unset($list[$bid]);
        Session::set('list',$list);
        if($flag==0) {
            return $this->success('已移除', 'preBorrow');
        }
        else{
            return true;
        }
    }

    public function returnAction($rid){
        $this->Pcheck();
        $r1 = $this->returnBook($rid);
        $r2 = $this->returnRecord($rid);

        if($r1 && $r2){
            $this->success("已成功归还", 'personalBook');
        }
        else{
            $this->error("归还失败");
        }
    }
    private function returnBook($rid){
        $record = model('Record')->where('rid',$rid)->find();
        $bid = $record->bid;
        $book = model('Book');
        $result = $book -> save([
            'holderId' => 0,
            'isOut' => 0
        ],['bid'=>$bid]);

        if($result){
            return true;
        }
        else{
            return false;
        }
    }
    private function returnRecord($rid){
        $record = model("Record");

        $result = $record->save([
            'isBack' =>1
        ], ['rid' =>$rid]);

        if($result){
            return true;
        }
        else{
            return false;
        }
    }

    public function delete($bid){
        $book = model('Book')->where('bid',$bid)->find();

        if($book->delete()){
            return $this->success('删除成功','viewBook');
        }
        else{
            return $this->error('删除失败');
        }

    }

}