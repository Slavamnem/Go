<?php

namespace App\Kernel\Classes;

class Defender
{
    public static $denied = [
        "'",
        "\"",
        "+",
        "DROP",
        "TRUNCATE",
        "\\",
        "?",
    ];

    public static function checkUrlParameter($urlItem, $routeItem)
    {
        if (self::needInt($routeItem)) {
            return is_numeric($urlItem);
        } elseif (self::needString($routeItem)) {
            return self::isSafeString($urlItem);
        }
        return true;
    }

    public static function isSafeString($string)
    {
        foreach (self::$denied as $denied) {
            if (strpos($string, $denied) !== false) {
                return false;
            }
        }
        return true;
    }

    public static function needInt($value)
    {
        return (strpos($value, ":d") !== false);
    }

    public static function needString($value)
    {
        return (strpos($value, ":s") !== false);
    }
}