<?php

namespace App\Kernel;

use App\Kernel\Classes\Facades\SiteLoad;
use App\Kernel\Classes\Response;
use App\Kernel\Classes\Request;
use App\Kernel\Classes\Facades\Config;
use App\Kernel\Classes\Facades\File;
use PHPUnit\Runner\Exception;

class Easy
{
    public $workMode;

    public function initialize()
    {
        $this->workMode = Config::get("app", "work-mode");
    }

    public function start()
    {
        $this->initialize();
        $request = new Request();

        $connector = connector();
        $connector->send([
            'sender' => 'App\Kernel\Easy',
            'receiver' => 'App\Kernel\Classes\Facades\Realizators\FileWorker',
            'data' => [1,2,3]
        ]);

        if (SiteLoad::check()) {
            Response::getResponse($request);
        } else {
            SiteLoad::overloadResponse();
        }
    }

}

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