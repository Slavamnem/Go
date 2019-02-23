<?php

namespace App\Project\Storage\Copies;

use App\Kernel\Classes\PdoHelper;

class DatabaseCopy2019_02_06_01_12_05
{
    public static $createTablesSqls;
    public static $insertDataSqls;

    public static function restore()
    {
        $allQueries = self::$createTablesSqls + self::$insertDataSqls;
        foreach ($allQueries as $query) {
            dump($query);
            //$stmp = PdoHelper::getPdo()->prepare($query);
            //$stmp->execute();
        }
    }

}