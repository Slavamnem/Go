<?php
namespace App\Kernel\Classes;

class Response{
    public static $controllerBaseNamespace = "App\Project\backend\controllers\\";
    public static $defaultController = "App\Project\backend\controllers\\HomeController";

    public static function getResponse(Request $request){
        try{
            $controller = new $request->controller();
            $method = $request->method;
            $controller->$method(...$request->arguments);
        } catch(\Throwable $e){
            self::defaultBehaviour();
        }
    }

    public static function defaultBehaviour(){
        call_user_func_array([self::$defaultController, "index"], []);
    }
}