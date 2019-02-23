<?php

namespace App\Kernel\Classes;

use App\Kernel\Classes\Interfaces\SqlBuilderInterface;

class SqlBuilder implements SqlBuilderInterface
{
    public function __construct(){}

    public static function selectSql($table, $joinTables = [])
    {
        $builder = new SqlBuilder();
        $sql = SqlTemplates::select($table);
        if ($joinTables) {
            $sql = $builder->addJoins($sql, $table, $joinTables);
        }

        return $sql;
    }

    public static function insertSql($tableName, $data)
    {
        $builder = new SqlBuilder();
        return "INSERT INTO {$tableName} ({$builder->makeFields($data)}) VALUES {$builder->makeValues($data)}";
    }

    public static function truncateSql($table, $size)
    {
        return "DELETE FROM {$table} 
              WHERE id NOT IN
                (SELECT id FROM 
                  (SELECT id FROM {$table} ORDER BY id ASC LIMIT {$size})
                x)
            ";
    }

    private function makeFields($data)
    {
        return implode(", ", array_keys($data[0]));
    }

    private function makeValues($data)
    {
        foreach ($data as $item) {
            $values[] = "('" . implode("', '", array_values($item)) . "')";
        }

        return implode(",", $values);
    }

    private function addJoins($sql, $currentTable, $joinTables)
    {
        foreach ($joinTables as $joinTable => $joinColumns) {
            $sql .= " LEFT JOIN {$joinTable} ON {$currentTable}.{$joinColumns[0]} = {$joinTable}.{$joinColumns[1]}";
        }
        return $sql;
    }
}