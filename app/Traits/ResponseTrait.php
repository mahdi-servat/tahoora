<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    public function json($data=[],$message='', $status = 200, array $headers = [], $options = 0): JsonResponse
    {
        $data = [
            'data'=>$data,
            'message' => $message
        ];
        return new JsonResponse($data, $status, $headers, $options);
    }
}
