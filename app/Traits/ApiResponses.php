<?php
namespace App\Traits;

trait ApiResponses {


  protected function okWithData($data){
    return response()->json($data, 200);
  }

  protected function ok($message){
    return $this->success($message, 200);
  }




  protected function success($message, $statusCode = 200){
    return response()->json([
      'message' => $message,
      'status' => $statusCode
    ], $statusCode);

  }
  protected function error($error, $statusCode = 400){
    return response()->json([
      'error' => $error,
      'status' => $statusCode
    ], $statusCode);

  }

}