<?php
/**
* @author Rizki tirta 2022
* Response Trait
*/

namespace App\Traits;

trait ResponseTrait
{

    public $success = true;
    public $data = null;
    public $message = null;
    public $code = \Illuminate\Http\Response::HTTP_OK;

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function json() : \Illuminate\Http\JsonResponse
    {
        $result = [];
        $result['success'] = $this->success;
        $result['message'] = $this->message;
        $result['data'] = $this->data;
        $result['code'] = $this->code;

        return response()->json($result, $this->code, [], JSON_PRETTY_PRINT);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function SuccessResponse($message,$data,$code=200) : \Illuminate\Http\JsonResponse
    {
        $result = [];
        $result['success'] = true;
        $result['message'] = $message;
        $result['data'] = $data;
        $result['code'] = $code;

        return response()->json($result, $this->code, [], JSON_PRETTY_PRINT);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ErrorResponse($message,$code=500) : \Illuminate\Http\JsonResponse
    {
        $result = [];
        $result['success'] = false;
        $result['message'] = $message;
        $result['data'] = null;
        $result['code'] = $code;

        return response()->json($result, $this->code, [], JSON_PRETTY_PRINT);
    }
}
