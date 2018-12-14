<?php
namespace App\Kernel\Classes\Facades\Realizators;

use App\Kernel\Classes\Facades\Config;

class Database
{
    public $pdo;

    public function __construct(){
        $host = Config::get("db", "host");
        $login = Config::get("db", "login");
        $password = Config::get("db", "password");
        $dbname = Config::get("db", "dbname");
        $charset = "utf8";

        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
//        $opt = [
//            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
//            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
//            PDO::ATTR_EMULATE_PREPARES   => false,
//        ];
        $this->pdo = new \PDO($dsn, $login, $password);//, $opt);
        dump($this->pdo);
        dump($host);
    }
    public function show(){
        $stmp = $this->pdo->prepare("SELECT * FROM users");
        $stmp->execute();
        dump($stmp->fetchAll());
    }
}