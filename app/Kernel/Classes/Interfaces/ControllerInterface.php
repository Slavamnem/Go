<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 24.11.2018
 * Time: 0:59
 */
namespace App\Kernel\Classes\Interfaces;

interface ControllerInterface{
    public function __construct();
    public function render($view, $data = []);
    public function redirect($path, $data = []);
    public function initializeFilters($filters);
    public function hasMethod($method);
    public function getPath();

    public static function getFullPath($extraPath, $file);
    public static function getShortName($file);
}