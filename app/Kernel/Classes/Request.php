<?php
namespace App\Kernel\Classes;

class Request{
    public static $controllerBaseNamespace = "App\Project\backend\controllers\\";
    public static $routesFile = "./app/Project/backend/routes.php";
    public $controller;
    public $method;
    public $arguments;

    public function __construct()
    {
        list($this->controller, $this->method, $this->arguments) = $this->getRequest();
    }

    public function getRequest(){
        $url = getUrl();
        $routes = getRoutes(self::$routesFile);

        $urlToRouter = new UrlToRoute();
        list($controller, $method, $arguments) = $urlToRouter->getRouteFromUrl($url, $routes);

        $controller = self::$controllerBaseNamespace.$controller;
        return [$controller, $method, $arguments];
    }
}