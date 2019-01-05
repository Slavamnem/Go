<?php
namespace App\Kernel\Classes;

use App\Kernel\Classes\Facades\Config;
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

    public function __construct()
    {
        $this->controllersDir = Config::get("controllers", "controllers-dir");
    }

    public function getRouteFromUrl($url, $routes)
    {
        if ($url) {
            $this->addExtraRoutesForUnusualParams($routes);
            foreach ($routes as $route => $executer) {
                if ($this->isMatch($url, $route)) {
                    return array_merge(explode("->", $executer), [$this->arguments]);
                }
            }
            return $this->tryToFindController($url);
        } else {
            return ["HomeController", "index", []];
        }
    }

    public function tryToFindController($url)
    {
        $result = $this->findControllerInDir($this->controllersDir, $url, 0);
        return $result?? [Config::get("controllers", "default-controller-name"), "index", []];
    }

    public function findControllerInDir($dir, $url, $level, $path = [])
    {
        $urlToArr = explode("/", $url);
        $controllersDir = opendir($dir);
        while (false !== ($file = readdir($controllersDir))) {
            // if we haven't enough parameters to use controllers methods
            if (count($urlToArr) < $level + 1) {
                return false;
            } elseif (is_dir($dir."/".$file) and !in_array($file, [".", ".."]) and $file == $urlToArr[$level]){
                $newPath = array_merge($path, [$file]);
                $result = $this->findControllerInDir($dir."/".$file, $url, $level+1, $newPath);
                if ($result) return $result;
            } elseif ($this->isRightController($file, $urlToArr[$level])) {
                $extraPath = ($level > 0)? implode('\\', $path)."\\" : "";
                $method = (count($urlToArr) <= $level + 1)? "index" : $urlToArr[$level + 1];

                $var = explode(".", $this->controllersDir.$extraPath.$file);
                $controller = new $var[0]();

                if (method_exists($controller, $method)) {
                    return [
                        $extraPath.explode(".", $file)[0],
                        $method,
                        $this->getArgumentsFromUrl($urlToArr, $level)
                    ];
                }
            }

        }
        return false;
    }

    public function isRightController($file, $urlItem)
    {
        return in_array(Controller::getNameFromFile($file), [$urlItem, ucfirst($urlItem)]);
    }

    public function getArgumentsFromUrl($urlToArr, $level)
    {
        return array_slice($urlToArr, $level + 2);
    }

    public function isMatch($url, $route)
    {
        $this->arguments = [];
        $urlToArr = explode("/", $url);
        $routeToArr = explode("/", $route);

        return ArrayHelper::isMatch($urlToArr, $routeToArr, $this, "compareItems");
    }

    public function compareItems($urlItem, $routeItem)
    {
        if (strlen($urlItem) > 0) {
            if (strpos($routeItem, "{") !== false) {
                return $this->checkParameter($urlItem, $routeItem);
            } else {
                return ($urlItem == $routeItem) ? true : false;
            }
        } else {
            return false;
        }
    }

    public function checkParameter($urlItem, $routeItem)
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
        } else {
            return true;
        }
    }

    public function addExtraRoutesForUnusualParams(&$routes)
    {
        $resultRoutes = $routes;
        $routeListNumber = 1;

        foreach ($routes as $route => $executer) {
            $routeParameters = Route::getItems($route);
            $extraRoutes = Route::getCleanRouter($route, $executer);

            foreach (Route::unnecessaryParametersGenerator($routeParameters) as $position => $item){
                $extraRoutes[Route::getCleanRouteFromItems($routeParameters, $position)] = $executer;
            }

            if (count($extraRoutes) > 1) {
                Route::addIntoList($resultRoutes, $extraRoutes, $routeListNumber);
            }

            $routeListNumber += count($extraRoutes);
        }
        $routes = $resultRoutes;
    }
}