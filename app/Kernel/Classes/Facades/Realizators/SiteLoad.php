<?php
namespace App\Kernel\Classes\Facades\Realizators;

class SiteLoad
{
    public function __construct(){}

    public function check()
    {
        return true;
    }

    public function overloadResponse()
    {
        dump("Нагрузка на сайт слишком велика. Подождите пару минут.");
    }

}