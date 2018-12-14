<?php
namespace App\Kernel\Classes\Facades;

class Facade{
    public static $baseNamespace = "App\Kernel\Classes\Facades\Realizators\\";
    public static $realizator;

    public static function __callStatic($name, $arguments){
        $controllerClassName = self::$baseNamespace.static::$realizator;
        $controller = new $controllerClassName();
        return $controller->$name(...$arguments);
        //forward_static_call_array([self::$baseNamespace.static::$realizator, $name], $arguments);
    }
}