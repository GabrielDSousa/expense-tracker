<?php

namespace Gabsdsousa\ExpenseTrackr\Routes;

use Gabsdsousa\ExpenseTrackr\Controllers\HealthController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class HealthRoutes implements RouteInterface
{
    public function update(RouteCollection $routes): RouteCollection
    {
        $this->controller = new HealthController();

        $routes->add('is_alive', new Route('/', [
            "_controller" => [$this->controller, 'index']
        ], [], [], '', [], ['GET']));

        return $routes;
    }
}
