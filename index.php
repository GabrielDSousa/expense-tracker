<?php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Dotenv\Dotenv;
use Gabsdsousa\ExpenseTrackr\Routes\RouteLoader;

// Load the .env file
$dotenv = Dotenv::createImmutable(__DIR__); // Points to the root directory where .env is located
$dotenv->load();

$request = Request::createFromGlobals();
$routes = new RouteCollection();

// Load all routes
$routes = RouteLoader::load($routes);

// Create Context and Matcher
$context = new RequestContext();
$context->fromRequest($request);

$matcher = new UrlMatcher($routes, $context);

try {
    $parameters = $matcher->match($request->getPathInfo());
    call_user_func($parameters['_controller'], $request);
} catch (ResourceNotFoundException $e) {
    echo new Response('Route Not Found', 404);
}

function getTransactions(Request $request)
{
    echo new Response('Fetching transactions...');
}

function createTransaction(Request $request)
{
    echo new Response('Creating transaction...');
}
