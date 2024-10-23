<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Gabsdsousa\ExpenseTrackr\Controllers\HealthController;
use Gabsdsousa\ExpenseTrackr\Controllers\Controller;

it('checks if the API is alive', function () {
    // Create a mock request for the root endpoint "/"
    $request = Request::create('/', 'GET');

    // Create an instance of your ApiController
    $controller = new HealthController();

    // Call the index method and capture the response
    $response = $controller->index($request);

    // Check if the response status is 200 (HTTP_OK)
    expect($response->getStatusCode())->toBe(Response::HTTP_OK);

    // Check if the response content is the expected JSON
    expect($response->getContent())->toBe('{"success":true,"message":"API is online"}');

    // Check if the content-type is application/json
    expect($response->headers->get('Content-Type'))->toBe('application/json');
});
