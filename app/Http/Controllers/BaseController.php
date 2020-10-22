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
                'current_page' => 1,
                'list' => $list
            ]
        ], 200);
    }
}