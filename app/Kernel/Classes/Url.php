<?php
namespace App\Kernel\Classes;

class Url
{
    public static function urlGenerator(){
        foreach ($_REQUEST as $key => $item){
            if(preg_match("/parameter[0-9]+/", $key)){
                yield $item;
            }
        }
    }
    public static function buildUrl(){
        foreach (self::urlGenerator() as $item) {
            $params[] = $item;
        }
        return @implode("/", $params);
    }
}