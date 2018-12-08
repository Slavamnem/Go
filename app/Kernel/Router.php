<?php

namespace App\Kernel;
use App\Kernel\Classes\Facades\File;
use App\Kernel\Classes\Facades\Config;
use App\Kernel\Classes\UrlToRoute;

use App\Project\backend\controllers;
use PHPUnit\Runner\Exception;


class Router{
    public static $controllerBaseNamespace = "App\Project\backend\controllers\\";
    public static $routesFile = "./app/Project/backend/routes.php";

    public static function urlGenerator(){
        foreach ($_REQUEST as $key => $item){
            if(preg_match("/parameter[0-9]+/", $key)){
                yield $item;
            }
        }
    }
    public static function buildUrl(){
        foreach (self::urlGenerator() as $item) {
            $params[] = $item;
        }
        return @implode("/", $params);
    }

    public static function sendRequest(){
        $url = self::buildUrl();
        $routes = require self::$routesFile;

        $urlToRouter = new UrlToRoute();
        list($controller, $method, $arguments) = $urlToRouter->getRouteFromUrl($url, $routes);
        $controller = self::$controllerBaseNamespace.$controller;

        try{
            $controller = new $controller();
            $controller->$method(...$arguments);
        } catch(\Throwable $e){
            call_user_func_array([self::$controllerBaseNamespace."HomeController", "index"], []);
            //echo "<br><br><h4 align='center'>Поймал ошибку!<br><br>".$e->getMessage()."</h4>";
        }


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