<?php

namespace App\Kernel\Classes;

use App\Kernel\Classes\ArgumentObjects\RequestHandlerData;
use App\Kernel\Classes\Facades\Config;

class ControllerSearcher extends FileSearchService
{
    public $url;
    public $controllersDir;

    public function __construct($url)
    {
        $this->url = $url;
        $this->controllersDir = Config::get("controllers", "controllers-dir");
    }

    public function search($dir, $extraPath = [], $deep = 0)
    {
        $currentDir = opendir($dir);
        while (false !== ($file = readdir($currentDir))) {
            if ($this->hasEnoughParams($deep + 1)) {
                if ($this->isMatchingDir($dir, $file, $deep)) {
                    $this->prepareForDiving($deep, $dir, $extraPath, $file);

                    if ($this->search($dir, $extraPath, $deep)){
                        return $this->search($dir, $extraPath, $deep);
                    }
                } elseif ($this->isMatchingController($file, $deep)) {
                    if ($deep) {
                        $controller = new Controller($this->getControllerFullPath($extraPath, $file));
                    } else {
                        $controller = new Controller($this->controllersDir . basename($file, ".php"));
                    }

                    if ($controller->hasMethod($this->getMethodFromUrl($deep))) {
                        return new RequestHandlerData(
                            $controller->getPath(),
                            $this->getMethodFromUrl($deep),
                            $this->getArgumentsFromUrl($deep)
                        );
                    }
                }
            } else {
                return false;
            }
        }
    }

    // controller section

    private function getControllerFullPath($extraPath, $file)
    {
        return $this->controllersDir . implode('\\', $extraPath) . "\\" . basename($file, ".php");
    }

    private function isMatchingController($fileName, $deep)
    {
        return Controller::getShortName($fileName) == ucfirst($this->urlAsArray()[$deep]);
    }

    // end controller section

    private function getMethodFromUrl($deep){
        return (count($this->urlAsArray()) <= $deep + 1) ? "index" : $this->urlAsArray()[$deep + 1];
    }

    private function getArgumentsFromUrl($deep)
    {
        return array_slice($this->urlAsArray(), $deep + 2);
    }

    private function prepareForDiving(&$deep, &$dir, &$extraPath, $file)
    {
        $deep++;
        $dir .= "/" . $file;
        $extraPath = array_merge($extraPath, [$file]);
    }

    private function isMatchingDir($dir, $file, $deep)
    {
        return ($this->isRealDir($dir, $file) and $this->hasMatchWithUrl($file, $deep));
    }

    private function isRealDir($dir, $file)
    {
        return (is_dir($dir . "/" . $file) and !in_array($file, [".", ".."]));
    }

    private function hasMatchWithUrl($fileName, $deep)
    {
        return $fileName == $this->urlAsArray()[$deep];
    }

    private function urlAsArray()
    {
        return explode("/", $this->url);
    }

    private function hasEnoughParams($needCount)
    {
        return (count($this->urlAsArray()) >= $needCount);
    }

}