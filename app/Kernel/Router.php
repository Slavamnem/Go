<?php

namespace App\Kernel;
use App\Kernel\Classes\Facades\File;
use App\Kernel\Classes\Facades\Config;
//use App\Project\backend\controllers\TestController;

use App\Project\backend\controllers;

class Router{
    //public static $controllerBaseNamespace = "App\Project\backend\controllers\\";
    public static $controllerBaseNamespace = "App\Project\backend\controllers\\";

    public static $routes = [
        "ru/test/game" => "TestController->game",
        "en/test/money" => "TestController->money",
        "ru/post/1" => "PostController->show",
        "ru/post/update/1" => "PostController->update",
    ];

    public static function sendRequest($url){
        if(array_key_exists($url, self::$routes)){
            list($controller, $method) = explode("->", self::$routes[$url]);
            $controller = self::$controllerBaseNamespace.$controller;

            $controller = new $controller();
            $controller->$method();
        }

        return;
        File::save("test");
        echo "<br>";
        echo Config::get("lang");
        echo "<br>";
        echo Config::get("messages.not-found.ru");
    }
}
//call_user_func([self::$controllerBaseNamespace.$controller, $method]);