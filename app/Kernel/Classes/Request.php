<?php
namespace App\Kernel\Classes;

use App\Kernel\Classes\Facades\Config;
use App\Kernel\Classes\Interfaces\UrlToRouteInterface;

class Request
{
    public $controllersDir;
    public $routesFile;
    public $controller;
    public $method;
    public $arguments;

    public function __construct()
    {
        $this->controllersDir = Config::get("app", "controllers-dir");
        $this->routesFile = Config::get("app", "routes-file");
        list($this->controller, $this->method, $this->arguments) = $this->buildRequest(new UrlToRoute());
    }

    public function buildRequest(UrlToRouteInterface $urlToRouter)
    {
        $url = getUrl();
        $routes = getRoutes($this->routesFile);

        list($controller, $method, $arguments) = $urlToRouter->getRouteFromUrl($url, $routes);

        $controller = "{$this->controllersDir}{$controller}";
        return [$controller, $method, $arguments];
    }
}