<?php

namespace App\Kernel\Classes;

class ProductionWorkMode extends WorkMode
{
    public static $errorsMode = 0;

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