<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use InfyOm\Generator\Utils\ResponseUtil;
use Response;
use Validator;

class AppBaseController extends Controller
{
    public function sendResponse($result, $message): JsonResponse
    {
        return Response::json(ResponseUtil::makeResponse($message, $result));
    }

    public function sendError($error, $code = 500): JsonResponse
    {
        return Response::json(ResponseUtil::makeError($error), $code);
    }

    public function sendSuccess($message): JsonResponse
    {
        return Response::json([
            'success' => true,
            'message' => $message,
        ], 200);
    }

    /**
     * @return null|string|void
     */
    public function validateRules($request, $rules, $ruleMessage = [])
    {
        $validator = Validator::make($request, $rules, $ruleMessage);
        if ($validator->fails()) {
            return $validator->messages()->first();
        }
    }
}
