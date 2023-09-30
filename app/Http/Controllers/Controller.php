<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    
    public function successMessage($message="Success", $status=200)
    {
        return response()->json($message, $status);
    }
    public function errorMessage($message="Internal Server Error", $status=500)
    {
        return response()->json($message, $status);
    }
    public function validationError($errors=[], $status=422)
    {
        return response()->json($errors, $status);
    }

    public function mobileData($data=[], $message="Data Fetched", $status=200)
    {
        return response()->json([
            'data'=>$data,
            'status'=>$status,
            'message'=>$message,
        ], $status);
    }

    public function mobileSuccess($message="Success", $status=200)
    {
        return response()->json([
            'message'=>$message,
            'status'=>$status,
        ], $status);
    }


    public function mobileError($message="Internasl server error", $status=500)
    {
        return response()->json([
            'message'=>$message,
            'status'=>$status,
        ], $status);
    }

    public function mobileValidationError($data=[], $message="Unprocessable Data",  $status=422)
    {
        return response()->json([
            'data'=>$data,
            'message'=>$message,
            'status'=>$status,
        ], $status);
    }
}
