<?php

namespace Gabsdsousa\ExpenseTrackr\Routes;

use Gabsdsousa\ExpenseTrackr\Controllers\TransactionController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class TransactionRoutes implements RouteInterface
{
    public function update(RouteCollection $routes): RouteCollection
    {
        $this->controller = new TransactionController();

        $routes->add('get_transactions', new Route('/transactions', [
            "_controller" => [$this->controller, 'index']
        ], [], [], '', [], ['GET']));

        $routes->add('create_transaction', new Route('/transactions', [
            "_controller" => [$this->controller, 'store']
        ], [], [], '', [], ['POST']));

        return $routes;
    }
}
