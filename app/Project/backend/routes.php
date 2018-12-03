<?php

return [
    "" => "HomeController->index",
    "ru/test/game" => "TestController->game",
    "en/test/money" => "TestController->money",
    "ru/post/get/{message}" => "PostController->get",
    "ru/post/{id:d}" => "PostController->show",
    //"ru/post/{update?}/{id:d?}" => "PostController->update",
    "ru/post/update/{id:d?}" => "PostController->update",
    "ru/post/{cat:s}/{id:d}" => "PostController->show2",
];