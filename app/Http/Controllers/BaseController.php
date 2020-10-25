<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class BaseController extends Controller
{
    public function responseWithPagination($total, $list)
    {

        return response()->json([
            'success' => 1,
            'data' => [
                'total' => $total,
                'count' => count($list),
                'per_page' => PRODUCT_PAGINATION,
                'list' => $list
            ]
        ], 200);
    }

    public function responseErrorWithMessage($message, $exMessage)
    {
        return response()->json([
            'success' => 0,
            'data' => $message,
            'errors' => [
                'message' => $exMessage,
            ]
        ], 500);
    }

    public function responseError($error)
    {
        return response()->json([
            'success' => 0,
            'data' => $error
        ], 404);
    }

    public function responseErrors($error)
    {
        return response()->json([
            'success' => 0,
            'data' => $error
        ], 422);
    }

    public function responseWithMessage($message)
    {
        return response()->json([
            'success' => 1,
            'data' => $message
        ], 200);
    }
}