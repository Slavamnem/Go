<?php
namespace App\Kernel\Classes\Facades\Realizators;

use App\Kernel\Classes\Facades\Config;
use App\Kernel\Classes\Facades\File;

class DatabaseCopy{
    private $pdo;
    public $createTablesSql;
    public $insertDataSql;
    public $createTableTemplate = "CREATE TABLE";
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function create($tables){
        foreach ($tables as $table){
            $tableName = array_values($table)[0];
            //$stmp = $this->pdo->prepare("SELECT * FROM {$tableName}");
            $stmp = $this->pdo->prepare("SHOW COLUMNS FROM {$tableName}");
            $stmp->execute();
            $fields = $stmp->fetchAll();
            //dump($fields);
            dump($this->getCreateTableSql($tableName, $fields));

            $this->createTablesSql[] = $this->getCreateTableSql($tableName, $fields);
            //dump($stmp->fetchAll());
        }

    }
    public function getCreateTableSql($tableName, $fields){
        $result = "CREATE TABLE {$tableName} (<br>";
        foreach ($fields as $key => $field){
            $result .= "{$field['Field']} {$field['Type']},<br>";
        }
//            id int,
//            title varchar(255),
//            text text,
//            author int,
//            PRIMARY KEY (id),
//            FOREIGN KEY (author) REFERENCES users(id)
        $result .= "<br>)";
        return $result;
    }
    public function test(){
        echo "copy works!";
    }

}
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
        $opt = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $this->pdo = new \PDO($dsn, $login, $password, $opt);
        //dump($this->pdo);
        //dump($host);
    }
    public function makeCopy(){
        //$stmp = $this->pdo->prepare("SHOW COLUMNS FROM users");

        //$stmp = $this->pdo->prepare("SHOW TABLES");
        //$stmp->execute();

        $tables = $this->getTables();
        $copy = new DatabaseCopy($this->pdo);
        $copy->create($tables);

      //  File::save("reserve/2.txt", serialize($copy));
        dump(serialize($copy));
        //$obj = unserialize(serialize($copy));
        //dump($obj);
        //$obj->test();

        File::save("reserve/1.txt", $tables);
       // dump($tables);
    }
    public function getTables(){
        $stmp = $this->pdo->prepare("SHOW TABLES");
        $stmp->execute();
        return $stmp->fetchAll();
    }
    public function show(){
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