<?php

namespace App\Kernel;
use App\Kernel\Classes\Facades\File;
use App\Kernel\Classes\Facades\Config;
use App\Kernel\Classes\UrlToRoute;

use App\Project\backend\controllers;

class Router{
    public static $routes = [
        "" => "HomeController->index",
        "ru/test/game" => "TestController->game",
        "en/test/money" => "TestController->money",
        "ru/post/{id:d}" => "PostController->show",
        "ru/post/update/{id:d}" => "PostController->update",
        "ru/post/{cat:s}/{id:d}" => "PostController->show2",
    ];

    public static $controllerBaseNamespace = "App\Project\backend\controllers\\";

    public static function buildUrl(){
        $params = [];
        for($i = 1; $i <= Config::get("url-levels"); $i++){
            if($_REQUEST["par".$i]) $params[] = $_GET["par".$i];
        }
        return (count($params))? implode("/", $params) : "";
    }

    public static function sendRequest(){
        $url = self::buildUrl(); //echo $url."<br>";

        $urlToRouter = new UrlToRoute();

        list($controller, $method, $arguments) = $urlToRouter->getRouteFromUrl($url, self::$routes);

        $controller = self::$controllerBaseNamespace.$controller;

        call_user_func_array([$controller, $method], $arguments);

        ////////////////////////////////////////////////////////
        echo "<br>_____________________________________<br>";
        return;
        File::save("test");
        echo "<br>";
        echo Config::get("lang");
        echo "<br>";
        echo Config::get("messages.not-found.ru");
    }
}
//call_user_func([self::$controllerBaseNamespace.$controller, $method]);