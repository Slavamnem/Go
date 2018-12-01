<?php
namespace App\Project\backend\controllers;

class TestController{
    public function __construct()
    {
        echo "TEST CONTROLLER STARTED<br>";
    }

    public function game(){
        echo "Welcome to game";
    }
    public function money(){
        echo "YOU WILL HAVE MONEY!";
    }
}