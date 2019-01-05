<?php
namespace App\Kernel\Classes\Facades\Realizators;

use App\Kernel\Classes\Facades\Config;
use App\Kernel\Classes\Facades\File;
use App\Kernel\Classes\PdoHelper;

class Database
{
    public $pdo;
    public $dbName;

    public function __construct(){
        $this->dbName = Config::get("db", "dbname");
        $this->pdo = PdoHelper::getPdo();
        //dump($this->pdo);
    }
    public function makeCopy(){
        $tables = $this->getTables();
        $copy = new DbCopy($this->pdo, $this->dbName);
        $copy->create($tables);
        $copy->test();

        //File::save("reserve/2.txt", serialize($copy));
        echo "<br>";
        //dump(json_encode($copy));
        echo "<br>";
        //dump(json_decode(json_encode($copy)));
        $o = json_decode(json_encode($copy));
        dump($o);
        //dump($o->createTablesSql);
        //echo serialize($copy);
        //$obj = unserialize(serialize($copy));
        //dump($obj);
        //$obj->test();

        File::save("reserve/1.txt", $tables);
       // dump($tables);
    }

    public function getTables()
    {
        $stmp = $this->pdo->prepare("SHOW TABLES");
        $stmp->execute();
        return $stmp->fetchAll();
    }

    public function getFields($table)
    {
        $stmp = $this->pdo->prepare("SHOW COLUMNS FROM {$table}");
        $stmp->execute();
        return $stmp->fetchAll();
    }

    public function show()
    {
        $stmp = $this->pdo->prepare("SELECT * FROM users WHERE id < :id");
        $stmp->execute(['id' => 4]);

       // dump($stmp->fetchAll());
        $users = $stmp->fetchAll();
        foreach ($users as $user){
            dump($user);
        }

        //$stmp = $this->pdo->prepare("SELECT login FROM users WHERE id = :id");
        $stmp = $this->pdo->prepare("SELECT COUNT (id) FROM users");
        $stmp->execute();//['id' => 3]);
        //$res = $stmp->fetchColumn();
        dump($stmp->fetchAll());
    }
}