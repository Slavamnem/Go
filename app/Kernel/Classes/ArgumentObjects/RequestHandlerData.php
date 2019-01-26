<?php

namespace App\Kernel\Classes\ArgumentObjects;

use App\Kernel\Classes\Facades\Config;

class RequestHandlerData
{
    public $controllersDir;
    private $controller;
    private $method;
    private $arguments;

    public function initialize()
    {
        $this->controllersDir = Config::get("controllers", "controllers-dir");
    }

    public function __construct($controller, $method, $arguments)
    {
        $this->initialize();
        $this->controller = $controller;
        $this->method = $method;
        $this->arguments = $arguments;
    }

    public function getController()
    {
        $controller = $this->getControllerFullName($this->controller);
        return new $controller();
    }

    public function getControllerFullName($name)
    {
        return $this->controllersDir . $name;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getArguments()
    {
        return $this->arguments;
    }

}