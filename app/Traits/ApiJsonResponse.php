<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiJsonResponse
{
    /**
     * Return Success JsonResponse
     *
     * @param  string|array $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($data, $code = Response::HTTP_OK) {
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
        return response()->json(['data' => $data], $code)->withHeaders($headers);
    }

    /**
     * Return Success JsonResponse
     *
     * @param  string|array $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function successHeaderWithToken($data, $apiToken, $code = Response::HTTP_OK) {
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $apiToken
        ];
        return response($data, $code)->withHeaders($headers);
    }

    /**
     * Return Error JsonResponse
     *
     * @param  string  $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($message, $code) {
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
        return response()->json(['error' => $message, 'code' => $code], $code)->withHeaders($headers);
    }


}
