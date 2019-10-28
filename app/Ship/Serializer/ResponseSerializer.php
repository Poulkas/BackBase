<?php

namespace App\Ship\Serializer;

class ResponseSerializer {
    /**
     * Serialize succcess.
     *
     * @param Mixed $data
     * @param String $message
     * @param Int $code
     * @param Array $custom
     *
     * @return array
     */
    public static function success(Mixed $data, String $message = null, Int $code = 200, Array $custom = []){
        $response = [
            'code' => $code,
            'data' => $data
        ];
        if($message!==null){
            $response['message'] = $message;
        }
        foreach ($custom as $key => $value) {
            $response[$key] = $value;
        }
        return response()->json($response, $code);
    }

    /**
     * Serialize an error.
     *
     * @param String $message
     * @param Mixed $data
     * @param Int $code
     * @param Array $custom
     *
     * @return array
     */
    public static function error(String $message, Mixed $data = null, Int $code = 422, Array $custom = []) {
        $response = [
            'message' => $message,
            'data' => $data
        ];
        foreach ($custom as $key => $value) {
            $response[$key] = $value;
        }
        \Log::info($code);
        return response()->json($response, $code);
    }

    /**
     * Serialize null.
     *
     * @return array
     */
    public static function null() {
        return response()->json(['data' => null]);
    }
}
