<?php
namespace App\Kernel\Classes\Facades\Realizators;

use App\Kernel\Classes\Facades\Config;
use App\Kernel\Classes\Facades\Db;
use App\Kernel\Classes\Facades\File;

class DbCopy{
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

    public function create($tables)
    {
        foreach ($tables as $table) {
            $tableName = array_values($table)[0];
            $fields = Db::getFields($tableName);
            $this->createTablesSql[] = $this->getCreateTableSql($tableName, $fields);
        }
    }

    public function deleteComa(&$value){
        $position = strrpos($value, ",");
        $value = substr($value, 0, $position).substr($value, $position+1);
        $value = str_replace("posts", "posts3", $value);
    }

    public function getCreateTableSql($tableName, $fields)
    {
        $result = $this->addCreateTitleBlock($tableName); //TODO br
        $this->addFieldsBlock($result, $fields); //TODO br
        $this->addPrimaryKeysBlock($result, $fields); //TODO br
        $this->addForeignKeysBlock($result, $tableName, $fields); //TODO br
        $result .= ")";
        $this->deleteComa($result);

        return str_replace("<br>", PHP_EOL, $result);
    }

    function addCreateTitleBlock($tableName)
    {
        return "CREATE TABLE {$tableName} (<br>"; //TODO br
    }

    public function addFieldsBlock(&$result, $fields)
    {
        foreach ($fields as $key => $field) {
            $extra = $field['Extra']? " {$field['Extra']}" : "";
            $result .= "{$field['Field']} {$field['Type']}{$extra},<br>"; //TODO br
        }
    }

    function addPrimaryKeysBlock(&$result, $fields)
    {
        $result.= "PRIMARY KEY ({$this->getPrimaryKeys($fields)}),<br>";
    }

    public function addForeignKeysBlock(&$result, $tableName, $fields)
    {
        foreach ($this->foreignKeysGenerator($tableName, $fields) as $foreignKey){
            $result .= "FOREIGN KEY ({$foreignKey['col']}) REFERENCES {$foreignKey['ref_table']}({$foreignKey['ref_column']}),<br>"; //TODO br
        }
    }

    public function getPrimaryKeys($fields)
    {
        $result = [];
        $primaryFields = array_filter($fields, function($field){
            return ($field['Key'] == "PRI")? true : false;
        });
        foreach($primaryFields as $field){
            $result[] = $field['Field'];
        }
        return implode(", ", $result);
    }

    public function foreignKeysGenerator($tableName, $values)
    {
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

        foreach ($references as $reference){
            yield $reference;
        }
    }

    public function test()
    {
        //dump($this->createTablesSql[0]);
        $stmp = $this->pdo->prepare($this->createTablesSql[1]);
        echo $stmp->execute();
    }

}