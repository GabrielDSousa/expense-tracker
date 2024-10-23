<?php

namespace Gabsdsousa\ExpenseTrackr\Routes;

use Symfony\Component\Routing\RouteCollection;

class RouteLoader
{
    public static function load(RouteCollection $routes): RouteCollection
    {
        // Define the list of route classes to be loaded
        $routeClasses = [
            HealthRoutes::class,
            TransactionRoutes::class
        ];

        // Loop through each class, instantiate it, and call the update method
        foreach ($routeClasses as $routeClass) {
            $routeInstance = new $routeClass();
            $routes = $routeInstance->update($routes);
        }

        return $routes;
    }
}
