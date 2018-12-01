<?php

namespace App\Kernel;
use App\Kernel\Classes\Facades\File;
use App\Kernel\Classes\Facades\Config;

class Router{
    public static $routes = [
        "ru/game" => "TestController->game",
        "en/money" => "TestController->money",
    ];

    public static function sendRequest($url){
        if(array_key_exists($url, self::$routes)){
            list($controller, $method) = explode("->", self::$routes[$url]);
            //echo $controller;

            //$object = new TestController();//$controller();
            //$object = new $controller;
            //$object->$method();
            echo 2;
        }
        //echo 3;

        File::save("test");
        echo "<br>";
        echo Config::get("lang");
        echo "<br>";
        echo Config::get("messages.not-found.ru");
    }
}