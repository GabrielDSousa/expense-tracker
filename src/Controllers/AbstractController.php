<?php

namespace Gabsdsousa\ExpenseTrackr\Controllers;

use Symfony\Component\HttpFoundation\Response;

abstract class AbstractController
{
    /**
     * Handle a JSON response.
     *
     * @param mixed $data
     * @param int $statusCode
     * @return Response
     */
    protected function jsonResponse($data, int $statusCode = Response::HTTP_OK): Response
    {
        return new Response(
            json_encode($data),
            $statusCode,
            ['Content-Type' => 'application/json']
        );
    }

    /**
     * Handle a successful response.
     *
     * @param string $message
     * @param array|null $data
     * @return Response
     */
    protected function successResponse(string $message, array $data = null): Response
    {
        $response = ['success' => true, 'message' => $message];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return $this->jsonResponse($response, Response::HTTP_OK);
    }

    /**
     * Handle an error response.
     *
     * @param string $message
     * @param int $statusCode
     * @return Response
     */
    protected function errorResponse(string $message, int $statusCode = Response::HTTP_BAD_REQUEST): Response
    {
        return $this->jsonResponse([
            'success' => false,
            'error' => $message
        ], $statusCode);
    }
}
