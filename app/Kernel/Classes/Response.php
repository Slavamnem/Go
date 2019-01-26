<?php
namespace App\Kernel\Classes;

use App\Kernel\Classes\ArgumentObjects\RequestHandlerData;
use App\Kernel\Classes\Facades\Config;

class Response
{
    public static function getResponse(RequestHandlerData $handlerData)
    {
        try {
            $controller = $handlerData->getController();
            $method = $handlerData->getMethod();
            $controller->$method(...$handlerData->getArguments());
        } catch(\Throwable $e) {
            dump($e->getMessage());
            self::defaultBehaviour();
        }
    }

    public static function defaultBehaviour()
    {
        call_user_func_array([Config::get("controllers", "default-controller"), "index"], []);
    }
}