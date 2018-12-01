<?php
namespace App\Kernel\Classes\Facades;

class Config extends Facade{
    public static function get($key){
        $config = require_once "./config/app.php";
        return $config[$key];
    }
}