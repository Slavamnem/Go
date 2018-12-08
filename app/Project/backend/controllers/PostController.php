<?php
namespace App\Project\backend\controllers;

use App\Kernel\Classes\Controller;

class PostController extends Controller{
    public function index(){
        echo "index";
    }
    public function show($id = 1){
        echo "Post №".$id."<br>";

        $items = ['a', 'b', 'c', 'd'];
        $this->render("test", compact('items'));
        //$this->redirect("/ru/post/show2", ['cat' => 10, 'id' => 44]);
    }
    public function show2($cat = 1, $id = 1){
        echo "Category: $cat, Post № $id <br>";
    }
    public function update($id = 1){
        echo "Update post № ".$id;
    }
    public function get($message = null){
        echo "yes it is get, message: $message";
    }

    //метод будет у главного контоллера, эти наследуют
    public function check($name) {
        return method_exists(__CLASS__, $name)? true : false;
    }
}