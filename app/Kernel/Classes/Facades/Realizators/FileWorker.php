<?php
namespace App\Kernel\Classes\Facades\Realizators;

class FileWorker{
    public static function save($message = "no message"){
        echo "File saved success! {$message}";
    }
}