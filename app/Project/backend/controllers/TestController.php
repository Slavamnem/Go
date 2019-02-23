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

    public function redis()
    {
        dump("redis page");


        //phpinfo();
        $redis = new \Redis();
        $redis->connect('127.0.0.1', 6379);
        $redis->set("test-key", 58);
        //$redis->delete("test-key");
        dump($redis->get("test-key"));

        $redis->rPush("arr1", 4);
        $redis->rPush("arr1", 14);
        $redis->rPush("arr1", 24);
        dump($redis->lGetRange('arr1', 0, 2));
        dump($redis->lGet('arr1', 1));
        dump($redis->hGetAll('arr1'));

    }

}