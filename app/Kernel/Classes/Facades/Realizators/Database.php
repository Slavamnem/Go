<?php
namespace App\Kernel\Classes\Facades\Realizators;

use App\Kernel\Classes\ArrayHelper;
use App\Kernel\Classes\Facades\Config;
use App\Kernel\Classes\Facades\File;
use App\Kernel\Classes\PdoHelper;
use App\Kernel\Classes\SqlTemplates;

class Database
{
    public $pdo;
    public $dbName;

    const COPIES_DIR = "App\Project\Storage\Copies\\";

    public function __construct(){
        $this->dbName = Config::get("db", "dbname");
        $this->pdo = PdoHelper::getPdo(); //dump($this->pdo);
    }

    /*
     *
     * select methods
     *
     */

    public function select($sql, $params = [], $single = false)
    {
        $stmp = $this->pdo->prepare($sql);
        $stmp->execute($params);

        foreach ($params as &$param) {
            $param = str_replace("\\\\", "\\", $param);
        }
        //dump($params); dump($stmp);
        return $single? $stmp->fetch() : $stmp->fetchAll();
    }

    public function selectForPage($table, $page, $limit)
    {
        $sql = SqlTemplates::selectForPage($table, $limit, ($page - 1) * $limit);
        return PdoHelper::getRes($sql);
    }

    public function selectFromTable($table, $joinTables = [])
    {
        if ($joinTables) {
            $sql = SqlTemplates::select($table);
            $sql = $this->addJoins($sql, $table, $joinTables);
        } else {
            $sql = SqlTemplates::select($table);
        }
        return PdoHelper::getRes($sql);
    }

    public function addJoins($sql, $currentTable, $joinTables)
    {
        foreach ($joinTables as $joinTable => $joinColumns) {
            $sql .= " LEFT JOIN {$joinTable} ON {$currentTable}.{$joinColumns[0]} = {$joinTable}.{$joinColumns[1]}";
        }
        return $sql;
    }

    public function getTableSize($table)
    {
        $sql = SqlTemplates::count($table);
        return PdoHelper::getRes($sql, "fetchColumn");
    }

    public function getTableColumns($table)
    {
        $sql = SqlTemplates::selectColumns($table);
        $columns = ArrayHelper::getField(PdoHelper::getRes($sql), "Field");
        return $columns;
    }

    public function getValue($sql, $params = [])
    {
        $stmp = $this->pdo->prepare($sql);
        $stmp->execute($params);
        return $stmp->fetchColumn();
    }

    /*
     * update
     */

    public function update($sql, $params = [])
    {
        $stmp = $this->pdo->prepare($sql);
        $stmp->execute($params);
    }

    /*
     * insert methods
     */

    public function insert($sql, $params = [])
    {
        $stmp = $this->pdo->prepare($sql);
        $stmp->execute($params);
    }

    public function insertInTable($tableName, $data)
    {
        try {
            if (!is_array($data[0])) {
                $data = [$data];
            }

            $fields = implode(", ", array_keys($data[0]));
            foreach ($data as $item) {
                $values[] = "('" . implode("', '", array_values($item)) . "')";
            }

            $values = implode(",", $values);
            $sql = "INSERT INTO {$tableName} ({$fields}) VALUES{$values}";
            $this->statement($sql);
        } catch (\Exception $e) {
            dump($e->getMessage());
        }

    }

    public function delete($sql, $params = [])
    {
        $this->statement($sql, $params);
    }

    public function statement($sql, $params = [])
    {
        $stmp = $this->pdo->prepare($sql);
        $stmp->execute($params);
    }

    public function truncate($table, $size = 0)
    {
        if ($size) {
            $sql = "DELETE FROM {$table} 
              WHERE id NOT IN
                (SELECT id FROM 
                  (SELECT id FROM {$table} ORDER BY id ASC LIMIT {$size})
                x)
            ";
            $this->statement($sql);
        } else {
            $this->statement("TRUNCATE {$table}");
        }
    }

    // TODO make only table copy
    public function makeCopy(){
        $tables = $this->getTables();
        $copy = new DbCopy($this->pdo, $this->dbName);
        $copy->create($tables);
    }

    public function restore($date = null) // TODO доделать
    {
        //dump("restore!");
        $copiesDir = opendir(self::COPIES_DIR);
        while (false !== ($file = readdir($copiesDir))) {
            if (count(explode("-", $date)) == 6) {
                if (strpos($file, $date)) {
                    $name = "copy-$date";
                    $copy = json_decode(File::get("Copies/{$name}.txt"));
                    dump($copy);

                    DbCopy::restore($copy);
                    //dump("found!");
                }
            } elseif (count(explode("-", $date)) == 3) {

            }
        }
    }

    public function getTables()
    {
        $tablesList = [];
        $stmp = $this->pdo->prepare("SHOW TABLES");
        $stmp->execute();

        foreach ($stmp->fetchAll() as $table) {
            $tablesList[] = array_values($table)[0];
        }
        return $tablesList;
    }

    public function getFields($table)
    {
        $stmp = $this->pdo->prepare("SHOW COLUMNS FROM {$table}");
        $stmp->execute();
        return $stmp->fetchAll();
    }

    public function show() //TODO какие-то опыты, удалит потом
    {
        $stmp = $this->pdo->prepare("SELECT * FROM users WHERE id < :id");
        $stmp->execute(['id' => 4]);

        $users = $stmp->fetchAll();
        foreach ($users as $user){
            dump($user);
        }

        $stmp = $this->pdo->prepare("SELECT COUNT (id) FROM users");
        $stmp->execute();
        dump($stmp->fetchAll());
    }

    public static function __callStatic($name, $arguments)
    {
        $self = new self();
        return $self->$name(...$arguments);
    }

}