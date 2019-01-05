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

        if (SiteLoad::check()) {
            Response::getResponse($request);
        } else {
            SiteLoad::overloadResponse();
        }
    }

}

//dump($request);
//dump("test");
//call_user_func([self::$controllerBaseNamespace.$controller, $method]);
////////////////////////////////////////////////////////
//echo "<br>_____________________________________<br>";
//return;
//File::save("test");
//echo "<br>";
//echo Config::get("app", "lang");
//echo "<br>";
//echo Config::get("app", "messages.not-found.ru");