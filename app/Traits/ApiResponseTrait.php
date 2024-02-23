<?php

namespace App\Traits;

trait ApiResponseTrait
{
    public function success_response ( $message = NULL) {
        return response()->json(['code' => 200, 'success' => true, 'message' => $message]);
    }
    public function success_response_with_data ($data = array(), $message = NULL) {
        return response()->json([ 'code' => 200, 'success' => true, 'message' => $message, 'data' => $data]);
    }

    public function error_response ($message = NULL, $code = 500) {
        return response()->json(['code' => $code, 'success' => false, 'message' => $message]);
    }
}
