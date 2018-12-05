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
        if(!$url) return ["HomeController", "index", []];
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
        $result = $this->findControllerInDir('app/Project/backend/controllers', $url, 0);
        return $result? $result : ["HomeController", "index", []];
    }

    public function findControllerInDir($dir, $url, $level, $path = []){
        //echo "|";
        $urlToArr = explode("/", $url);
        $controllers = opendir($dir);
        while (false !== ($file = readdir($controllers))) {
            //echo "|";
            if(count($urlToArr) < $level + 1){ return false; }
            if(is_dir($dir."/".$file) and !in_array($file, [".", ".."]) and $file == $urlToArr[$level]){
                //echo "1";
                $new_path = array_merge($path, [$file]);
                $result = $this->findControllerInDir($dir."/".$file, $url, $level+1, $new_path);
                if($result) return $result;
            }
            //echo $file."<br>";
            if(in_array(substr($file, 0, strpos($file, "Controller")), [$urlToArr[$level], ucfirst($urlToArr[$level])])){
                //echo "__";
                $extra_path = ($level > 0)? implode('\\', $path)."\\" : "";


                $method = (count($urlToArr) <= $level + 1)? "index" : $urlToArr[$level + 1];
                //echo $method.count($urlToArr);
                if(call_user_func([explode(".", self::$controllerBaseNamespace.$extra_path.$file)[0], "check"], $method)){
                    return [$extra_path.explode(".", $file)[0], $method, array_slice($urlToArr, $level + 2)];
                }
            }
        }
        return false;
    }

    public function isMatch($url, $route){
        $this->arguments = [];
        $urlToArr = explode("/", $url);
        $routeToArr = explode("/", $route);

        if(count($urlToArr) == count($routeToArr)){
//            print_r($urlToArr);
//            print_r($routeToArr);
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