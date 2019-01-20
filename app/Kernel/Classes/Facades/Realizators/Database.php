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
            foreach ($joinTables as $joinTable => $joinColumns) {
                $sql .= " LEFT JOIN {$joinTable} ON {$table}.{$joinColumns[0]} = {$joinTable}.{$joinColumns[1]}";
            }

            return PdoHelper::getRes($sql);
        } else {
            $stmp = $this->pdo->prepare(SqlTemplates::select($table));
            $stmp->execute();
            return $stmp->fetchAll();
        }
    }

    public function getTableSize($table)
    {
        $sql = SqlTemplates::count($table);
        return PdoHelper::getRes($sql, "fetchColumn");
    }

    public function getTableColumns($table)
    {
        $sql = SqlTemplates::selectColumns($table); //dump($sql);
        $columns = ArrayHelper::getFields(PdoHelper::getRes($sql), "Field");
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
        $stmp = $this->pdo->prepare($sql);
        $stmp->execute($params);
    }

    public function statement($sql, $params = [])
    {
        $stmp = $this->pdo->prepare($sql);
        $stmp->execute($params);
    }

    public function truncate($table, $size = 0)
    {
        if ($size) {
            //$this->statement("DELETE FROM");
        } else {
            $this->statement("TRUNCATE {$table}");
        }
    }

    // TODO make only table copy
    public function makeCopy(){
        $tables = $this->getTables();
        $copy = new DbCopy($this->pdo, $this->dbName);
        $copy->create($tables);
        //$copy->test();

        //FileService::save("reserve/2.txt", serialize($copy));
        echo "<br>";
        //dump(json_encode($copy));
        echo "<br>";
        //dump(json_decode(json_encode($copy)));
        $o = json_decode(json_encode($copy));
        //dump($o);
        //dump($o->createTablesSql);
        //echo serialize($copy);
        //$obj = unserialize(serialize($copy));
        //dump($obj);
        //$obj->test();

        //FileService::save("reserve/1.txt", json_encode($copy));
       // dump($tables);
    }

    public function restore($date = null)
    {
        dump("restore!");
        $copiesDir = opendir(self::COPIES_DIR);
        while (false !== ($file = readdir($copiesDir))) {
            if (count(explode("-", $date)) == 6) {
                if (strpos($file, $date)) {
                    $name = "copy-$date";
                    $copy = json_decode(File::get("Copies/{$name}.txt"));
                    dump($copy);

                    DbCopy::restore($copy);
                    //$copy->restore();
                    //dump($file);
                    dump("found!");
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

    public static function __callStatic($name, $arguments)
    {
        $self = new self();
        return $self->$name(...$arguments);
    }

}