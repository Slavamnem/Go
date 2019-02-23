<?php
namespace App\Kernel\Classes;

use App\Kernel\Classes\ArgumentObjects\RequestHandlerData;
use App\Kernel\Classes\Facades\Config;
use App\Kernel\Classes\Facades\File;
use App\Kernel\Classes\Interfaces\UrlToRouteInterface;
use App\Kernel\Url;

class UrlToRoute implements UrlToRouteInterface
{

    public $arguments = [];
    public $controllersDir;

    private $url;
    private $routes;
    private $router;

    public function __construct()
    {
        $this->url = getUrl();
        $this->routes = getRoutes();
        $this->router = new Route();
        $this->controllersDir = Config::get("controllers", "controllers-dir");
    }

    public function getRequestHandlerFromUrl()
    {
        if ($this->url) {
            $this->router->addExtraRoutesForUnusualParams($this->routes);
            foreach ($this->routes as $route => $executer) {
                $this->arguments = [];
                if ($this->isMatch($route)) {
                    return new RequestHandlerData(...$this->generateDataForHandler($executer));
                }
            }
            return $this->tryToFindController();
        }
        return $this->defaultHandler();
    }

    public function generateDataForHandler($executer)
    {
        return array_merge(explode("->", $executer), [$this->arguments]);
    }

    public function defaultHandler()
    {
        return new RequestHandlerData(Config::get("controllers", "default-controller-name"), "index", []);
    }

    public function tryToFindController()
    {
        $searcher = new ControllerSearcher($this->url);
        $result = $searcher->search($this->controllersDir);
        return $result ?? $this->defaultHandler();
    }

    public function isMatch($route)
    {
        return ArrayHelper::isMatch(
            explode("/", $this->url),
            explode("/", $route),
            $this,
            "compareItems"
        );
    }

    public function compareItems($urlItem, $routeItem) //TODO
    {
        if (strlen($urlItem) > 0) {
            if ($this->isUnusualParam($routeItem)) {
                array_push($this->arguments, $urlItem);
                return Defender::checkUrlParameter($urlItem, $routeItem);
            } else {
                return $urlItem == $routeItem;
            }
        }
        return false;
    }

    private function isUnusualParam($routeItem)
    {
        return (strpos($routeItem, "{") !== false);
    }

}