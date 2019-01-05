<?php
namespace App\Kernel\Classes;

use App\Kernel\Classes\Facades\Config;
use App\Kernel\Classes\Facades\File;
use App\Kernel\Classes\Interfaces\ControllerInterface;

class Controller implements ControllerInterface{

    public $viewsDir;

    public function __construct()
    {
        $this->viewsDir = Config::get("views", "views-dir");
    }

    public function render($view, $data = [], $layout = null, $layoutData = [])
    {
        if ($layout) {
            extract($layoutData);
            $content = File::makeVar($this->getViewFile($view), $data);
            include $this->getLayoutFile($layout);
        } else {
            extract($data);
            include $this->getViewFile($view);
        }
    }

    public function getViewFile($name)
    {
        return "{$this->viewsDir}{$name}.php";
    }

    public function getLayoutFile($name)
    {
        return "{$this->viewsDir}layouts/{$name}.php";
    }

    public function redirect($path, $data = [])
    {
        $refresh = $path;
        $uri = implode("/", $data);
        $refresh .= (count(data) > 0)? "/".$uri : "";
        exit("<meta http-equiv='refresh' content='0; url= {$refresh}'>");
    }

    public function initializeFilters($filters)
    {

    }

    public static function getNameFromFile($file)
    {
        return substr($file, 0, strpos($file, "Controller"));
    }

}