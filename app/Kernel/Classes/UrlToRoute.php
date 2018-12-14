<?php
namespace App\Kernel\Classes;

use App\Kernel\Url;

class UrlToRoute{
    public static $controllerBaseNamespace = "App\Project\backend\controllers\\";

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

    public function getRouteFromUrl($url, $routes){
        if($url){
            $this->addExtraRoutesForUnusualParams($routes);
            foreach($routes as $route => $executer){
                if($this->isMatch($url, $route)){
                    return array_merge(explode("->", $executer), [$this->arguments]);
                }
            }
            return $this->tryToFindController($url);
        }
        else{
            return ["HomeController", "index", []];
        }
    }

    public function tryToFindController($url){
        $result = $this->findControllerInDir(self::$controllerBaseNamespace, $url, 0);
        return $result? $result : ["HomeController", "index", []];
    }

    public function findControllerInDir($dir, $url, $level, $path = []){
        $urlToArr = explode("/", $url);
        $controllers = opendir($dir);
        while (false !== ($file = readdir($controllers))) {

            if(count($urlToArr) < $level + 1){ return false; }
            elseif(is_dir($dir."/".$file) and !in_array($file, [".", ".."]) and $file == $urlToArr[$level]){
                $new_path = array_merge($path, [$file]);
                $result = $this->findControllerInDir($dir."/".$file, $url, $level+1, $new_path);
                if($result) return $result;
            }
            elseif(in_array(substr($file, 0, strpos($file, "Controller")), [$urlToArr[$level], ucfirst($urlToArr[$level])])){
                $extra_path = ($level > 0)? implode('\\', $path)."\\" : "";
                $method = (count($urlToArr) <= $level + 1)? "index" : $urlToArr[$level + 1];

                $var = explode(".", self::$controllerBaseNamespace.$extra_path.$file);
                $controller = new $var[0]();
                if($controller->check($method)){
                    return [$extra_path.explode(".", $file)[0], $method, array_slice($urlToArr, $level + 2)];
                }
//                if(call_user_func([explode(".", self::$controllerBaseNamespace.$extra_path.$file)[0], "check"], $method)){
//                    return [$extra_path.explode(".", $file)[0], $method, array_slice($urlToArr, $level + 2)];
//                }
            }

        }
        return false;
    }

    public function isMatch($url, $route){
        $this->arguments = [];
        $urlToArr = explode("/", $url);
        $routeToArr = explode("/", $route);

        if(count($urlToArr) == count($routeToArr)){
            for($i = 0; $i < count($urlToArr); $i++){
                if(!$this->compareItems($urlToArr[$i], $routeToArr[$i])){
                    return false;
                }
            }
            return true;
        }
        else{
            return false;
        }
    }

    public function compareItems($urlItem, $routeItem){
        if(strlen($urlItem) > 0) {
            if (strpos($routeItem, "{") !== false) {
                return $this->checkParameter($urlItem, $routeItem);
            } else {
                return ($urlItem == $routeItem) ? true : false;
            }
        }
        else{
            return false;
        }
    }


    public function checkParameter($urlItem, $routeItem){
        array_push($this->arguments, $urlItem);
        if (strpos($routeItem, ":d") !== false) {
            return (is_numeric($urlItem)) ? true : false;
        }
        elseif (strpos($routeItem, ":s") !== false) {
            for ($i = 0; $i < count($this->denied); $i++) {
                if(strpos($urlItem, $this->denied[$i]) !== false){
                    return false;
                }
            }
            return true;
        } else {
            return true;
        }
    }

    public function unnecessaryParametersGenerator($routeParameters){
        foreach ($routeParameters as $key => $item){
            if(strpos($item, "?") !== false){
                yield $key => $item;
            }
        }
    }
    public function getCleanExtraRoute($routeParameters, $position){
        return str_replace("?", "", implode("/", array_slice($routeParameters, 0, $position)));
    }
    public function addExtraRoutesForUnusualParams(&$routes){
        $resultRoutes = $routes;
        $routeListNumber = 1;

        foreach($routes as $route => $executer){
            $routeParameters = explode("/", $route);
            $extraRoutes = [str_replace("?", "", $route) => $executer];
            foreach ($this->unnecessaryParametersGenerator($routeParameters) as $position => $item){
                $extraRoutes[$this->getCleanExtraRoute($routeParameters, $position)] = $executer;
            }

            if(count($extraRoutes) > 1){
                $beforeRoutes = array_slice($resultRoutes, 0, $routeListNumber - 1);
                $afterRoutes = array_slice($resultRoutes, $routeListNumber);
                $resultRoutes = array_merge($beforeRoutes, $extraRoutes, $afterRoutes);
            }

            $routeListNumber += count($extraRoutes);
        }
        $routes = $resultRoutes;
    }
}