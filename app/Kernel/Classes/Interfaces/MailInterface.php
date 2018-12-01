<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 24.11.2018
 * Time: 0:59
 */
namespace App\Kernel\Classes\Interfaces;

interface MailInterface{
    public static function send($data);
    public static function get($key);
    public static function getHistory($user);
}