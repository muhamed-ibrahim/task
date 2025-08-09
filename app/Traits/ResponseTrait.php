<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    public function success200($data = null, $message = 'Success'): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'status' => 200,
            'message' => $message,
        ], 200);
    }

    public function success201($data = null, $message = 'Created'): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'status' => 201,
            'message' => $message,
        ], 201);
    }

    public function success202($data = null): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'status' => 202,
            'message' => 'The request has been accepted for processing',
        ], 202);
    }

    public function error400($errors = null, $message = 'Bad Request'): JsonResponse
    {
        return response()->json([
            'errors' => $errors,
            'status' => 400,
            'message' => $message,
        ], 400);
    }

    public function error401($errors = 'Unauthorized', $message = 'Unauthorized'): JsonResponse
    {
        return response()->json([
            'status' => 401,
            'errors' => $errors,
            'message' => $message,
        ], 401);
    }

    public function error403($errors = 'Forbidden'): JsonResponse
    {
        return response()->json([
            'errors' => $errors,
            'status' => 403,
            'message' => 'Forbidden',
        ], 403);
    }

    public function error404($message = 'Not Found'): JsonResponse
    {
        return response()->json([
            'status' => 404,
            'message' => $message,
            'errors' => 'Not Found',
        ], 404);
    }

    public function error422($errors, $message = 'Unprocessable Content'): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'status' => 422,
            'errors' => $errors,

        ], 422);
    }

    public function error500($errors = null, $message = 'Internal Server Error'): JsonResponse
    {
        return response()->json([
            'errors' => $errors,
            'status' => 500,
            'message' => $message,
        ], 500);
    }
}

