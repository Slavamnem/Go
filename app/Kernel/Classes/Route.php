<?php
namespace App\Kernel\Classes;

class Route
{
    public static function getItems($route)
    {
        return explode("/", $route);
    }

    public static function addIntoList(&$resultRoutes, $extraRoutes, $position = null)
    {
        if ($position) {
            $beforeRoutes = array_slice($resultRoutes, 0, $position - 1);
            $afterRoutes = array_slice($resultRoutes, $position);
            $resultRoutes = array_merge($beforeRoutes, $extraRoutes, $afterRoutes);
        } else {
            $resultRoutes += $extraRoutes;
        }
    }

    public static function getCleanRouter($route, $executer)
    {
        return [str_replace("?", "", $route) => $executer];
    }

    public static function getCleanRouteFromItems($items, $position)
    {
        return str_replace("?", "", implode("/", array_slice($items, 0, $position)));
    }

    public static function unnecessaryParametersGenerator($routeItems)
    {
        foreach ($routeItems as $key => $item) {
            if (strpos($item, "?") !== false){
                yield $key => $item;
            }
        }
    }
}
