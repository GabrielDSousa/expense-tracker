<?php

namespace Gabsdsousa\ExpenseTrackr\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HealthController extends AbstractController
{
    // Check if api is online
    public function index(Request $request): Response
    {
        // Return a JSON response with 200 OK status
        return $this->successResponse('API is online');
    }
}
