<?php
namespace App\Kernel\Classes;

use App\Kernel\Classes\Facades\Config;

class PdoHelper
{
    public static function getPdo()
    {
        $host = Config::get("db", "host");
        $login = Config::get("db", "login");
        $password = Config::get("db", "password");
        $dbName = Config::get("db", "dbname");
        $charset = "utf8";

        $dsn = "mysql:host=$host;dbname=$dbName;charset=$charset";
        $opt = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        return new \PDO($dsn, $login, $password, $opt);
    }

    public static function getRes($sql, $mode = "fetchAll"){
        $stmp = self::getPdo()->prepare($sql);
        $stmp->execute();
        return $stmp->$mode();
    }
}