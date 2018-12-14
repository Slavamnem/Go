<?php

namespace App\Kernel;
use App\Kernel\Classes\Facades\File;
use App\Kernel\Classes\Facades\Config;
use App\Kernel\Classes\UrlToRoute;
//use App\Kernel\Url;

use App\Project\backend\controllers;
use PHPUnit\Runner\Exception;

class Router
{
    public static $controllerBaseNamespace = "App\Project\backend\controllers\\";
    public static $routesFile = "./app/Project/backend/routes.php";


    public static function sendRequest(){
        $url = getUrl();
        $routes = require self::$routesFile;
        //dump(explode("/", $url));
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
        //dump("test");

        ////////////////////////////////////////////////////////
        echo "<br>_____________________________________<br>";
        return;
        File::save("test");
        echo "<br>";
        echo Config::get("app", "lang");
        echo "<br>";
        echo Config::get("app", "messages.not-found.ru");
    }
}
//call_user_func([self::$controllerBaseNamespace.$controller, $method]);