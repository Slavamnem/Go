<?php

namespace App\Kernel;
use App\Kernel\Classes\Facades\File;
use App\Kernel\Classes\Facades\Config;
use App\Kernel\Classes\UrlToRoute;

use App\Project\backend\controllers;

class Router{
    public static $controllerBaseNamespace = "App\Project\backend\controllers\\";

    public static function buildUrl(){
        $params = [];
        for($i = 1; $i <= Config::get("url-levels"); $i++){
            if($_REQUEST["par".$i]) $params[] = $_REQUEST["par".$i];
        }
        return (count($params))? implode("/", $params) : "";
    }

    public static function sendRequest(){ // сделать необязательные параметры роутам
        $url = self::buildUrl();
        $routes = require "./app/Project/backend/routes.php";

        $urlToRouter = new UrlToRoute();

        list($controller, $method, $arguments) = $urlToRouter->getRouteFromUrl($url, $routes);
        //print_r($arguments);
        $controller = self::$controllerBaseNamespace.$controller;

        call_user_func_array([$controller, $method], $arguments);

//        $handle = opendir('app/Project/backend/controllers');
//        while (false !== ($file = readdir($handle))) {
//            echo "$file<br>";
//        }

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