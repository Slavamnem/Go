<?php
namespace App\Kernel\Classes\Facades;

class Config extends Facade
{
    public static function get($file, $keys)
    {
        $config = self::getFile($file);
        $keys = explode(".", $keys);
        $result = $config[$keys[0]];

        for ($i = 1; $i < count($keys); $i++) {
            $result = $result[$keys[$i]];
        }
        return $result;
    }

    public static function getFile($name)
    {
        return require "./config/{$name}.php";
    }

}