<?php

return [
    //'work-mode' => \App\Kernel\Classes\DevelopWorkMode::class,
    'work-mode' => \App\Kernel\Classes\ProductionWorkMode::class,
    'log-file' => "./app/Kernel/Data/Logs/Log.txt",
    'errors-mode' => E_ALL,
    'lang' => 'ru',
    'messages' => [
        'not-found' => [
            'en' => 'Not found!',
            'ru' => 'Не найдено!',
        ],
    ],
    'url-levels' => 10,
    'controllers-dir' => "App\Project\backend\controllers\\",
    'default-controller' => "App\Project\backend\controllers\\HomeController",
    'routes-file' => "./app/Project/backend/routes.php"
];