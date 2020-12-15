<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{   

    /**
     * @param mixed $data
     * @param bool $success
     * @param string $message
     * @param int $code
     * 
     * @return Illuminate\Http\JsonResponse 
    */
    public function response($data = [], bool $success = true, string $message = 'OK', int $code = 200)
    {
        $response = [
            'success' => $success,
            'message' => $message,
        ];

        if ($success) {
            $response['data'] = $data;
        }else{
            if(!empty($data))
                $response['errors'] = $data;
        }

        return response()->json($response)->setStatusCode($code);
    }


    
}
