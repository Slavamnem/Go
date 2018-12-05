<?php
namespace App\Project\backend\controllers;

class AdminController{
    public function index($message = ""){
        echo "Admin Controller welcome!!!<br>";
        echo $message;
    }
    public function money($message = ""){
        echo "Admin Controller welcome2!!!<br>";
        echo $message;
    }
    public function check($name) {
        return method_exists(__CLASS__, $name)? true : false;
    }
}