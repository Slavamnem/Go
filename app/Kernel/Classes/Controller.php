<?php
namespace App\Kernel\Classes;

use App\Kernel\Classes\Facades\Config;
use App\Kernel\Classes\Facades\File;
use App\Kernel\Classes\Interfaces\ControllerInterface;

class Controller implements ControllerInterface{

    public $fullPath;
    public $viewsDir;

    public function __construct($fullPath = null)
    {
        $this->fullPath = $fullPath;
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

    public function redirect($path, $data = []) // TODO fix
    {
        $refresh = $path;
        $uri = implode("/", $data);
        $refresh .= (count($data) > 0)? "/". $uri : "";
        exit("<meta http-equiv='refresh' content='0; url= {$refresh}'>");
    }

    public function initializeFilters($filters){} // TODO

    //
    public function hasMethod($method)
    {
        return method_exists($this->fullPath, $method);
    }

    public function getPath()
    {
        if (strpos($this->fullPath, Config::get("controllers", "controllers-dir")) !== false) {
            return substr($this->fullPath, strlen(Config::get("controllers", "controllers-dir")));
        }
        return $this->fullPath;
    }
    //
    public static function getFullPath($extraPath, $file)
    {
        $controllersDir = Config::get("controllers", "controllers-dir");
        return $controllersDir . implode('\\', $extraPath) . "\\" . basename($file, ".php");
    }

    public static function getShortName($file)
    {
        return substr($file, 0, strpos($file, "Controller"));
    }

    //
    private function getViewFile($name)
    {
        return "{$this->viewsDir}{$name}.php";
    }

    private function getLayoutFile($name)
    {
        return "{$this->viewsDir}layouts/{$name}.php";
    }

}