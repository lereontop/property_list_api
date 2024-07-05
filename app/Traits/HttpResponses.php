<?php
    namespace App\Traits;

    trait HttpResponses{
        protected function success($data, $message = null, $code = 200){
            return response()->json([
                'status' => 'Request was Succesful',
                'message' => $message,
                'data' => $data
            ], $code);

        }


        protected function erorr($data, $message = null, $code ){
            return response()->json([
                'status' => 'Erorr has  occurred',
                'message' => $message,
                'data' => $data
            ], $code);

        }
    }

?>
