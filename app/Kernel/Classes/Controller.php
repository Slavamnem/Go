<?php
namespace App\Kernel\Classes;

use App\Kernel\Classes\Interfaces\ControllerInterface;

class Controller implements ControllerInterface{

    const VIEWS_DIR = "./app/Project/frontend/views/";

    public function render($view, $data = []){
        extract($data);
        include self::VIEWS_DIR.$view.".php";
    }
    public function check($name) {
        $obj = new $this();
        return method_exists($obj, $name)? true : false;
    }
    public function redirect($path, $data = []){
        $refresh = $path;
        $uri = implode("/", $data);
        $refresh .= (count(data) > 0)? "/".$uri : "";
        exit("<meta http-equiv='refresh' content='0; url= {$refresh}'>");
    }
    public function initializeFilters($filters){

    }
}