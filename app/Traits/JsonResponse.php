<?php
/**
 * Created by PhpStorm.
 * User: LAMLAM
 * Date: 10/5/2019
 * Time: 1:17 PM
 */

namespace App\Traits;


trait JsonResponse
{
    /**
     * Success Response
     *
     * @param $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function success($data = null, $code = 200, $headers = [], $options = 0){
        return response()->json([
            'success' => true,
            'data' => $data
        ], $code, $headers, $options);
    }

    /**
     * Error Response
     *
     * @param string $message
     * @param array $errors
     * @param int $code
     * @param int $httpCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function error($message, $errors = [], $code = 400, $httpCode = 400){
        $response = [
            'code' => $code,
            'message' => $message
        ];
        if(!empty($errors)) {
            $response['errors'] = $errors;
        }
        return response()->json([
            'error' => $response
        ], $httpCode);
    }
}
