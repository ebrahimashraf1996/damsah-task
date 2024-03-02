<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiHelperTrait{
    
    public function returnAllDataJSON($data = [], $collection , $status = true,
        $code = 200 , $message = '')
    { 
        return response()->json([
            'code' => $code,
            'status' => $status,
            'message' => $message,
            'data' => $data,
            'pagination' => $collection,
        ], $code);
    }

    /**
     * JSON response for APIs
     *
     * @param bool $status
     * @param string|array $message
     * @param array $data
     * @param int $code
     * @return Response
     */
    public function returnJSON($data = [], $status = true,
        $code = 200, $message = '')
    { 
        return response()->json([
            'code' => $code,
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * Return response for success opertation
     *
     * @return Response
     */
    public function returnSuccess($message = 'Your request done successfully')
    {
        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => $message,
        ], 200);
    }

    /**
     * Return response for success opertation
     *
     * @return Response
     */
    public function returnWrong($message = 'Your Request Is Invalid' ,  $code = JsonResponse::HTTP_BAD_REQUEST)
    {
        return response()->json([
            'code' => $code,
            'status' => false,
            'message' => $message ,
        ], $code);
    }

}
