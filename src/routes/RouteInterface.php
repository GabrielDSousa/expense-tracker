<?php

namespace Gabsdsousa\ExpenseTrackr\Routes;

use Gabsdsousa\ExpenseTrackr\Controllers\AbstractController;
use Symfony\Component\Routing\RouteCollection;

interface RouteInterface
{
    protected AbstractController $controller;

    public function update(RouteCollection $routes): RouteCollection;
}
