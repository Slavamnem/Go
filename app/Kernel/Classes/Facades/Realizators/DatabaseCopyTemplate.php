<?php

namespace App\Project\Storage\Copies;

use App\Kernel\Classes\PdoHelper;

class DatabaseCopy
{
    const TRIES_LIMIT = 500;

    public static $pdo;
    public static $insertDataSqls;
    public static $createTablesSqls;

    public static function restore()
    {
        self::$pdo = PdoHelper::getPdo();
        self::tryToExecute(self::$createTablesSqls);
        self::tryToExecute(self::$insertDataSqls);
    }

    private static function tryToExecute($queries)
    {
        $doneQueries = [];

        $errorsAmount = 0;
        while (count($doneQueries) < count($queries)){
            foreach ($queries as $query) {
                if ($errorsAmount > self::TRIES_LIMIT){
                    return;
                } elseif (!in_array($query, $doneQueries)) {
                    try {
                        $stmp = self::$pdo->prepare($query);
                        $stmp->execute();
                        array_push($doneQueries, $query);
                    } catch (\Exception $exception) {
                        $errorsAmount++;
                        continue;
                    }
                }
            }
        }
    }
}