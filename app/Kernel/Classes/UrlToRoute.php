<?php
namespace App\Kernel\Classes;

use App\Kernel\Classes\ArgumentObjects\RequestHandlerData;
use App\Kernel\Classes\Facades\Config;
use App\Kernel\Classes\Facades\File;
use App\Kernel\Classes\Interfaces\UrlToRouteInterface;
use App\Kernel\Url;

class UrlToRoute implements UrlToRouteInterface
{

    public $controllersDir;

    public $denied = [
        "'",
        "\"",
        "+",
        "DROP",
        "TRUNCATE",
        "\\",
        "?",
    ];

    public $arguments = [];
    private $router;

    public function __construct()
    {
        $this->router = new Route();
        $this->controllersDir = Config::get("controllers", "controllers-dir");
    }

    public function getRequestHandlerFromUrl($url, $routes)
    {
        if ($url) {
            $this->router->addExtraRoutesForUnusualParams($routes);
            foreach ($routes as $route => $executer) {
                $this->arguments = [];
                if ($this->isMatch($url, $route)) {
                    return new RequestHandlerData(...$this->generateDataForHandler($executer));
                }
            }
            return $this->tryToFindController($url);
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

    public function tryToFindControllerOld($url)
    {
        $result = $this->findControllerInDir($this->controllersDir, $url, 0);
        return $result ?? $this->defaultHandler();
    }

    public function tryToFindController($url)
    {
        $searcher = new ControllerSearcher($url);
        $result = $searcher->search($this->controllersDir);
        return $result ?? $this->defaultHandler();
    }

    public function isMatch($url, $route)
    {
        return ArrayHelper::isMatch(
            explode("/", $url),
            explode("/", $route),
            $this,
            "compareItems"
        );
    }

    public function compareItems($urlItem, $routeItem) //TODO
    {
        if (strlen($urlItem) > 0) {
            if (strpos($routeItem, "{") !== false) {
                return $this->checkParameter($urlItem, $routeItem);
            } else {
                return $urlItem == $routeItem;
            }
        }
        return false;
    }

    public function checkParameter($urlItem, $routeItem) //TODO
    {
        array_push($this->arguments, $urlItem);

        if (strpos($routeItem, ":d") !== false) {
            return (is_numeric($urlItem)) ? true : false;
        } elseif (strpos($routeItem, ":s") !== false) {
            for ($i = 0; $i < count($this->denied); $i++) {
                if (strpos($urlItem, $this->denied[$i]) !== false) {
                    return false;
                }
            }
            return true;
        }
        return true;
    }

}