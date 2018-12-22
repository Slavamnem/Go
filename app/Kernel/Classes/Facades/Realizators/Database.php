<?php
namespace App\Kernel\Classes\Facades\Realizators;

use App\Kernel\Classes\Facades\Config;
use App\Kernel\Classes\Facades\File;

class DatabaseCopy{
    private $dbname;
    private $pdo;
    public $createTablesSql;
    public $insertDataSql;
    public $createTableTemplate = "CREATE TABLE";
    public function __construct($pdo, $dbname)
    {
        $this->pdo = $pdo;
        $this->dbname = $dbname;
    }

    public function create($tables){
        foreach ($tables as $table){
            $tableName = array_values($table)[0];
            $stmp = $this->pdo->prepare("SHOW COLUMNS FROM {$tableName}");
            $stmp->execute();
            $fields = $stmp->fetchAll();
           // dump($fields);
            //dump($this->getCreateTableSql($tableName, $fields));

            $this->createTablesSql[] = $this->getCreateTableSql($tableName, $fields);
            //dump($stmp->fetchAll());
        }

    }

    public function getPrimaryKeys($fields){
        $result = [];
        $primaryFields = array_filter($fields, function($field){
            return ($field['Key'] == "PRI")? true : false;
        });
        foreach($primaryFields as $field){
            $result[] = $field['Field'];
        }
        return implode(", ", $result);
    }
    public function foreignKeysGenerator($tableName, $values){
       // dump($this->dbname);
        $stmp = $this->pdo->prepare("
            SELECT I.COLUMN_NAME as col, I.REFERENCED_TABLE_NAME as ref_table, I.REFERENCED_COLUMN_NAME as ref_column
            FROM information_schema.key_column_usage as I 
            WHERE I.TABLE_SCHEMA = '{$this->dbname}' 
                AND I.TABLE_NAME = '{$tableName}'
                AND I.REFERENCED_TABLE_NAME IS NOT NULL
                AND I.REFERENCED_COLUMN_NAME IS NOT NULL
        ");

        $stmp->execute();
        $references = $stmp->fetchAll();
       // dump($references);
        foreach ($references as $reference){
            yield $reference;
           // dump($reference); echo "<br>";
        }
        //dump($references);
    }
    public function deleteComa($value){

    }
    public function getCreateTableSql($tableName, $fields){
        $result = "CREATE TABLE {$tableName} (<br>";
        foreach ($fields as $key => $field){
            $extra = $field['Extra']?? "";
            $result .= "{$field['Field']} {$field['Type']} {$extra},<br>";
        }
        //dump($this->getPrimaryKeys($fields));
        $result .= "PRIMARY KEY ({$this->getPrimaryKeys($fields)}),<br>";
//
        foreach ($this->foreignKeysGenerator($tableName, $fields) as $foreignKey){
            $result .= "FOREIGN KEY ({$foreignKey['col']}) REFERENCES {$foreignKey['ref_table']}({$foreignKey['ref_column']}),<br>";
            //dump($foreignKey);
        }
        $result .= ")";
        return $result;
    }
    public function test(){
        echo "copy works!";
    }

}
class Database
{
    public $pdo;
    public $dbname;

    public function __construct(){
        $host = Config::get("db", "host");
        $login = Config::get("db", "login");
        $password = Config::get("db", "password");
        $dbname = $this->dbname = Config::get("db", "dbname");
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
        $copy = new DatabaseCopy($this->pdo, $this->dbname);
        $copy->create($tables);

      //  File::save("reserve/2.txt", serialize($copy));
        echo "<br>";
        //dump(json_encode($copy));
        echo "<br>";
//        dump(json_decode(json_encode($copy)));
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