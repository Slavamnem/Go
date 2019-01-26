<?php
namespace App\Kernel\Classes;

use App\Kernel\Classes\ArgumentObjects\RequestHandlerData;
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
                    dump($route);
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

    public function tryToFindController($url)
    {
        $result = $this->findControllerInDir($this->controllersDir, $url, 0);
        dump("try"); dump($result); dump("try");
        return $result ?? $this->defaultHandler();
    }

    public function findControllerInDir($dir, $url, $level, $path = []) //TODO
    {
        $urlToArr = explode("/", $url);
        $controllersDir = opendir($dir);
        while (false !== ($file = readdir($controllersDir))) {
            // if we haven't enough parameters to use controllers methods
            if (count($urlToArr) < $level + 1) {
                return false;
            } elseif (is_dir($dir . "/" . $file) and !in_array($file, [".", ".."]) and $file == $urlToArr[$level]) {
                $newPath = array_merge($path, [$file]);
                $result = $this->findControllerInDir($dir . "/" . $file, $url, $level + 1, $newPath);
                if ($result) return new RequestHandlerData(...$result);
            } elseif ($this->isController($file, $urlToArr[$level])) {
                $extraPath = ($level > 0) ? implode('\\', $path) . "\\" : "";
                $method = (count($urlToArr) <= $level + 1) ? "index" : $urlToArr[$level + 1];

                $var = explode(".", $this->controllersDir . $extraPath . $file);
                $controller = new $var[0]();

                if (method_exists($controller, $method)) {
                    return new RequestHandlerData(
                        $extraPath . explode(".", $file)[0],
                        $method,
                        $this->getArgumentsFromUrl($urlToArr, $level)
                    );
                }
            }

        }
        return false;
    }

    public function isController($file, $urlItem)
    {
        return in_array(Controller::getNameFromFile($file), [$urlItem, ucfirst($urlItem)]);
    }

    public function getArgumentsFromUrl($urlToArr, $level)
    {
        return array_slice($urlToArr, $level + 2);
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