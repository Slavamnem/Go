<?php
namespace App\Kernel\Classes\Facades\Realizators;

use App\Kernel\Classes\Facades\Config;
use App\Kernel\Classes\Facades\Db;
use App\Kernel\Classes\Facades\File;
use App\Kernel\Classes\PdoHelper;

class DbCopy{
    private $dbname;
    private $pdo;
    public $createTablesSql;
    public $insertDataSql;
    const TEMPLATE_DIR = "./app/Kernel/Classes/Facades/Realizators/";

    public function __construct($pdo, $dbname)
    {
        $this->pdo = $pdo ?? PdoHelper::getPdo();
        $this->dbname = $dbname;
    }

    public function create($tables)
    {
        foreach ($tables as $tableName) {
            $fields = Db::getFields($tableName);
            $this->getCreateTableSql($tableName, $fields);
            $this->getInsertDataSql($tableName, $fields);
        }

        $this->createCopy();
    }

    public function createCopy()
    {
        $template = File::get(self::TEMPLATE_DIR . "DatabaseCopyTemplate.php", true);

        $template = str_replace(
            'class DatabaseCopy',
            'class DatabaseCopy' . date("Y_m_d_H_i_s"),
            $template
        );

        $template = str_replace(
            'public static $createTablesSqls',
            'public static $createTablesSqls = ' . var_export($this->createTablesSql, true),
            $template
        );

        $template = str_replace(
            'public static $insertDataSqls',
            'public static $insertDataSqls = ' . var_export($this->insertDataSql, true),
            $template
        );

        $name = "DatabaseCopy".date("Y_m_d_H_i_s");
        File::save("Copies/{$name}.php", $template);
    }

    public function save()
    {
        $json = json_encode($this);
        $name = "copy-".date("Y-m-d-H-i-s");
        File::save("Copies/{$name}.txt", $json);
    }

    public static function restore($data) //TODO доделать
    {
        $allQueries = $data->createTablesSql + $data->insertDataSql;
        foreach ($allQueries as $query) {
            dump($query);
            $stmp = PdoHelper::getPdo()->prepare($query);
            $stmp->execute();
        }
    }

    ////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////// Insert sql block ////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////
    ///
    public function getInsertDataSql($tableName, $fields)
    {
        $result = $this->addInsertTitle($tableName);
        if ($this->addValues($result, $tableName)) {
            $this->insertDataSql[] = $result;
        }
    }

    public function addInsertTitle($tableName)
    {
        return "INSERT INTO {$tableName} VALUES";
    }

    public function addValues(&$result, $tableName)
    {
        $stmp = $this->pdo->prepare("SELECT * FROM {$tableName}");
        $stmp->execute();

        $values = [];
        foreach ($stmp->fetchAll() as $row) {
            $values[] = "('".implode("', '", array_values($row))."')";
        }

        if ($values) {
            $values = str_replace("''", "NULL", $values);
            $result .= implode(", ", $values);
            return true;
        } else {
            return false;
        }
    }

    ////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////// Create table sql block ////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////

    public function getCreateTableSql($tableName, $fields)
    {
        $result = $this->addCreateTitleBlock($tableName); //TODO br
        $this->addFieldsBlock($result, $fields); //TODO br
        $this->addPrimaryKeysBlock($result, $fields); //TODO br
        $this->addForeignKeysBlock($result, $tableName, $fields); //TODO br
        $result .= ")";
        $this->deleteComa($result);

        $this->createTablesSql[] = str_replace("<br>", PHP_EOL, $result); //TODO
    }

    function addCreateTitleBlock($tableName)
    {
        return "CREATE TABLE {$tableName} (<br>"; //TODO br
    }

    public function addFieldsBlock(&$result, $fields)
    {
        foreach ($fields as $key => $field) { //dump($field);
            $extra = $field['Extra']? " {$field['Extra']}" : "";
            $defaultNull = $field['Null'] == "YES" ? " DEFAULT NULL" : "";
            $result .= "{$field['Field']} {$field['Type']}{$extra}{$defaultNull},<br>"; //TODO br
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

    public function deleteComa(&$value)
    {
        $position = strrpos($value, ",");
        $value = substr($value, 0, $position).substr($value, $position+1);
    }

    public function test()
    {
        $stmp = $this->pdo->prepare($this->createTablesSql[1]);
        echo $stmp->execute();
    }

}