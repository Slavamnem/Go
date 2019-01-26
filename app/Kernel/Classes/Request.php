<?php
namespace App\Kernel\Classes;

use App\Kernel\Classes\Facades\Config;
use App\Kernel\Classes\Interfaces\UrlToRouteInterface;

class Request
{
    public $handlerData;

    public function __construct()
    {
        $this->buildRequest(new UrlToRoute());
    }

    public function buildRequest(UrlToRouteInterface $urlToRouter)
    {
        $this->handlerData = $urlToRouter->getRequestHandlerFromUrl(getUrl(), getRoutes());
    }

}