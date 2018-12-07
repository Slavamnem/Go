<?php
namespace App\Project\backend\controllers;

class PostController{
    public function index(){
        echo "index";
    }
    public function show($id = 1){
        echo "Post №".$id."<br>";
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