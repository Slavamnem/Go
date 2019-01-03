<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 24.11.2018
 * Time: 0:59
 */
namespace App\Kernel\Classes\Interfaces;

interface UrlToRouteInterface{

    public function getRouteFromUrl($url, $routes);
    public function tryToFindController($url);
    public function compareItems($urlItem, $routeItem);
    public function isMatch($url, $route);
}