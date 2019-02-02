<?php
namespace App\Kernel\Classes;

class Route
{
    public function getItems($route)
    {
        return explode("/", $route);
    }

    public function addIntoRoutesList(&$resultRoutes, $extraRoutes, $position = null)
    {
        if ($position) {
            $beforeRoutes = array_slice($resultRoutes, 0, $position - 1);
            $afterRoutes = array_slice($resultRoutes, $position);
            $resultRoutes = array_merge($beforeRoutes, $extraRoutes, $afterRoutes);
        } else {
            $resultRoutes += $extraRoutes;
        }
    }

    public function getCleanRouter($route, $executer)
    {
        return [str_replace("?", "", $route) => $executer];
    }

    public function getCleanRouteFromItems($items, $position)
    {
        return str_replace("?", "", implode("/", array_slice($items, 0, $position)));
    }

    public function unnecessaryParametersGenerator($routeItems)
    {
        foreach ($routeItems as $key => $item) {
            if (strpos($item, "?") !== false){
                yield $key => $item;
            }
        }
    }

    public function addExtraRoutesForUnusualParams(&$routes) // TODO неплохо бы отрефакторить
    {
        $resultRoutes = $routes;
        $routesListPosition = 1;

        foreach ($routes as $route => $executer) {
            $routeParameters = $this->getItems($route);
            $extraRoutes = $this->getCleanRouter($route, $executer);

            foreach ($this->unnecessaryParametersGenerator($routeParameters) as $position => $item){
                $extraRoutes[$this->getCleanRouteFromItems($routeParameters, $position)] = $executer;
            }

            if (count($extraRoutes) > 1) {
                $this->addIntoRoutesList($resultRoutes, $extraRoutes, $routesListPosition);
            }

            $routesListPosition += count($extraRoutes);
        }
        $routes = $resultRoutes;
    }
}
