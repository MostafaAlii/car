<?php
namespace App\Models\Traits\Api;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
trait ApiResponseTrait {
    protected function apiResponse(bool $success, $data = null, $message = null, int $statusCode = 200) {
        $response = ['status' => $success,];

        if ($message !== null)
            $response['message'] = $message;

        if ($data !== null)
            $response['data'] = $data;

        return response()->json($response, $statusCode);
    }

    protected function successResponse($data = null, ?string $message = null, int $statusCode = 200): JsonResponse {
        return $this->apiResponse(true, $data, $message, $statusCode);
    }


    protected function errorResponse($message = null, int $statusCode = 500): JsonResponse {
        return $this->apiResponse(false, null, $message, $statusCode);
    }

    protected function notFoundResponse(?string $message = null): JsonResponse {
        return $this->errorResponse($message, 404);
    }
}
