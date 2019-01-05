<?php
namespace App\Kernel\Classes;

use App\Kernel\Classes\Facades\Config;

class Response
{
    public static function getResponse(Request $request)
    {
        try {
            $controller = new $request->controller();
            $method = $request->method;
            $controller->$method(...$request->arguments);
        } catch(\Throwable $e) {
            self::defaultBehaviour();
        }
    }

    public static function defaultBehaviour()
    {
        call_user_func_array([Config::get("controllers", "default-controller"), "index"], []);
    }
}