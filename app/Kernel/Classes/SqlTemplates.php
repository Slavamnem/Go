<?php

namespace App\Kernel\Classes;

class SqlTemplates
{
    const SELECT = "SELECT * FROM {table}";
    const SELECT_FOR_PAGE = "SELECT * FROM {table} LIMIT {LIMIT} OFFSET {OFFSET}";
    const SELECT_COLUMNS = "SHOW COLUMNS FROM {table}";
    const COUNT = "SELECT COUNT(id) FROM {table}";
    const INSERT = "INSERT INTO {table} ({columns}) VALUES {values}";

    public static function select($table)
    {
        return preg_replace("/{table}/is", $table, SqlTemplates::SELECT);
    }

    public static function selectColumns($table)
    {
        return preg_replace("/{table}/is", $table, SqlTemplates::SELECT_COLUMNS);
    }

    public static function selectForPage($table, $limit = 1000, $offset = 0)
    {
        $res = preg_replace("/{table}/is", $table, SqlTemplates::SELECT_FOR_PAGE);
        $res = preg_replace("/{LIMIT}/is", $limit, $res);
        $res = preg_replace("/{OFFSET}/is", $offset, $res);
        return $res;
    }

    public static function count($table)
    {
        return preg_replace("/{table}/is", $table, SqlTemplates::COUNT);
    }
}