<?php

namespace App\Kernel\Classes\Interfaces;

interface SqlBuilderInterface
{
    public static function selectSql($table, $joinTables = []);

    public static function insertSql($tableName, $data);

    public static function truncateSql($table, $size);
}