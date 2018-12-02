<?php
namespace App\Kernel\Classes;

class UrlToRoute{

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
        foreach($routes as $route => $executer){
            if($this->isMatch($url, $route)){
                $result = explode("->", $executer);
                $result[] = $this->arguments;
                return $result;
            }
        }
        return ["HomeController", "index", []];
    }

    public function isMatch($url, $route){
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
}