<?php

namespace App\Kernel\Classes;

use App\Kernel\Classes\Facades\Config;

abstract class WorkMode
{
    public $name;

    public function __construct()
    {
        $this->name = $this->generateName();
        $this->setErrorReporting();
        $this->setErrorLogFile();
    }

    public function getName()
    {
        return $this->name;
    }

    public function generateName()
    {
        preg_match("/(\\w+)(WorkMode)/is", static::class, $matches);
        return $matches[1];
    }

    public function setErrorReporting()
    {
        error_reporting(Config::get("app", "errors-mode"));
    }

    public function setErrorLogFile()
    {
        ini_set("error_log", Config::get("app", "log-file"));
    }

    public function getErrorsMode()
    {
        return isset(self::$errorsMode) ? self::$errorsMode : Config::get("app", "errors-mode");
    }

    public static function create($mode)
    {
        return new $mode();
    }
}