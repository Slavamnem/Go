<?php
namespace App\Kernel\Classes\Facades;

class Config extends Facade{
    public static function get($keys){
        $config = require "./config/app.php";
        $keys = explode(".", $keys);
        $result = $config[$keys[0]];
        for($i = 1; $i < count($keys); $i++){
            $result = $result[$keys[$i]];
        }
        return $result;
    }
}