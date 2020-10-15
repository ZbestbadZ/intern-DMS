<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecommendIndexRequest;
use App\User;

class RecommendController extends Controller
{
    public function indexView()
    {
        return view('recommend.index');
    }

    public function index(RecommendIndexRequest $request)
    {
        $filter = $request->getFilter();
        $orderParams = $request->getOrderByParameters();
        $start = $request->input('start', 0);
        $recommendedQuery = User::getRecommended($filter, $orderParams, $start);
        $recommended = $recommendedQuery['users'];
        $recordsTotal = 0;
        $recordsFiltered = $recommendedQuery['recordsFiltered'];
        return response()->json(['data' => $recommended, 'recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered]);
    }


}
