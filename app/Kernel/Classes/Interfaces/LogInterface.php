<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 24.11.2018
 * Time: 0:59
 */
namespace App\Kernel\Classes\Interfaces;

interface LogInterface{
    public static function put($data);
    public static function get($key, $date);
}