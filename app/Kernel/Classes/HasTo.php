<?php

namespace App\Kernel\Classes;

class HasTo
{
    public static function on($bool)
    {
        if (!$bool) {
            dump("Has To Error!");
            dump("Необходимое условие не выполнилось!");
            dump(debug_backtrace()[1]);
            exit();
        }
    }
}