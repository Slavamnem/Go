<?php

namespace App\Kernel;

use App\Kernel\Classes\Response;
use App\Kernel\Classes\Request;
use App\Kernel\Classes\Facades\Config;
use App\Kernel\Classes\Facades\File;
use App\Kernel\Classes\SiteLoad;
use App\Kernel\Classes\WorkMode;
use PHPUnit\Runner\Exception;

class App
{
    public static $workMode;

    public static function initialize()
    {
        App::$workMode = WorkMode::create(Config::get("app", "work-mode"));
    }

    public static function start()
    {
        App::initialize();

        $request = new Request();
        if (SiteLoad::isTooHighLoad($request)) {
            SiteLoad::overloadResponse();
        } else {
            Response::getResponse($request->handlerData);
        }
    }

}





//dump(App::$workMode); dump(App::$workMode->getErrorsMode()); echo 9/0;
//        $connector = connector();
//        $connector->send([
//            'sender' => 'App\Kernel\App',
//            'receiver' => 'App\Kernel\Classes\Facades\Realizators\FileWorker',
//            'data' => [1,2,3]
//        ]);

//$file = new FileService()
//$file->clear();
//$file->delete();

//dump($request);
//dump("test");
//call_user_func([self::$controllerBaseNamespace.$controller, $method]);
////////////////////////////////////////////////////////
//echo "<br>_____________________________________<br>";
//return;
//FileService::save("test");
//echo "<br>";
//echo Config::get("app", "lang");
//echo "<br>";
//echo Config::get("app", "messages.not-found.ru");