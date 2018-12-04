<?php
namespace App\Kernel\Classes;

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
        $routes = $this->addRoutesUnusualParamsAccess($routes);
        foreach($routes as $route => $executer){
            if($this->isMatch($url, $route)){
                $result = explode("->", $executer);
                array_push($result, $this->arguments);
                return $result;
            }
        }
        return $this->tryToFindController($url);
    }
    public function tryToFindController($url){
        $urlToArr = explode("/", $url);
        $controllers = opendir('app/Project/backend/controllers');
        while (false !== ($file = readdir($controllers))) {
            if(in_array(substr($file, 0, strpos($file, "Controller")), [$urlToArr[0], ucfirst($urlToArr[0])])){
                if(call_user_func([explode(".", self::$controllerBaseNamespace.$file)[0], "check"], $urlToArr[1])){
                    return [explode(".", $file)[0], $urlToArr[1], array_slice($urlToArr, 2)];
                }
            }
        }
        return ["HomeController", "index", []];
    }

    public function isMatch($url, $route){
        $this->arguments = [];
        $urlToArr = explode("/", $url);
        $routeToArr = explode("/", $route);
        if(count($urlToArr) == count($routeToArr)){
            for($i = 0; $i < count($urlToArr); $i++){
                if(!$this->isSame($urlToArr[$i], $routeToArr[$i])){
                    return false;
                }
            }
            return true;
        }
        else{
            return false;
        }
    }

    public function isSame($urlItem, $routeItem){
        if(strlen($urlItem) > 0) {
            if (strpos($routeItem, "{") !== false) {
                $this->arguments [] = $urlItem;
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
            } else {
                return ($urlItem == $routeItem) ? true : false;
            }
        }
        else{
            return false;
        }
    }

    public function addRoutesUnusualParamsAccess($routes){
        $resultRoutes = $routes;
        $routePosition = 1;
        foreach($routes as $route => $executer){
            $routeItems = explode("/", $route);
            $itemLevel = 0;
            $newRoutes = [str_replace("?", "", $route) => $executer];
            foreach ($routeItems as $item){
                if(strpos($item, "?") !== false){
                    //print_r(array_slice($routes, 0, 3)); //print_r(array_slice($routeItems, 0, 3));
                    //echo implode("/", array_slice($routeItems, 0, $itemLevel)); echo "<br>";
                    $newRoutes[str_replace("?", "", implode("/", array_slice($routeItems, 0, $itemLevel)))] = $executer;
                }
                $itemLevel++;
            }

            if(count($newRoutes) > 1){
                $beforeRoutes = array_slice($resultRoutes, 0, $routePosition - 1);
                $afterRoutes = array_slice($resultRoutes, $routePosition);
                $resultRoutes = array_merge($beforeRoutes, $newRoutes, $afterRoutes);
            }

            $routePosition += count($newRoutes);
        }
        return $resultRoutes;
    }
}