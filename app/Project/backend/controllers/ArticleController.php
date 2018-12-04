<?php
namespace App\Project\backend\controllers;

class ArticleController{
    public function index($message = ""){
        echo "Article Controller welcome!!!<br>";
        echo $message;
    }
    public function check($name) {
        return method_exists(__CLASS__, $name)? true : false;
    }
}