<?php

namespace App\Kernel\Classes;

class DevelopWorkMode extends WorkMode
{
    public static $errorsMode = E_ALL;

    public function __construct()
    {
        parent::__construct();
    }

    public function setErrorReporting()
    {
        if (isset(self::$errorsMode)) {
            error_reporting(self::$errorsMode);
        } else {
            parent::setErrorReporting();
        }
    }
}