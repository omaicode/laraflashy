<?php


namespace Omaicode\Modules\Traits;


use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponser
{
    protected function successResponse($data = null, $message = null, $code = 200, $append = []): JsonResponse
    {
        $response = [
            'success' => true,
            'code' => $code,
            'message' => $message ? $message : Response::$statusTexts[$code],
            'data' => $data
        ];

        if (isset($append) && is_array($append) && !blank($append)) {
            $response = array_merge($response, $append);
        }

        return response()->json($response, $code);
    }

    protected function errorResponse($message = null, $code): JsonResponse
    {
        return response()->json([
            'success' => false,
            'code' => $code,
            'message' => $message ? $message : Response::$statusTexts[$code],
            'data' => null
        ], $code);
    }
}
