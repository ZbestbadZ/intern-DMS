<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    public function index(Request $request)
    {
        $start = $request->input('start', 0);
        $query = Product::skip($start)->take(PRODUCT_PAGINATION);
        $total = Product::select('id')->count();
        $products = $query->get();
        
        return $this->responseWithPagination($total, $products);
    }
}