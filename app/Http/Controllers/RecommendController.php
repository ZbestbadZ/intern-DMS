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
        $recordsTotal = $recommendedQuery['recordsTotal'];
        $recordsFiltered = $recommendedQuery['recordsFiltered'];
        $html = view('modal.message', compact('user'))->render();
        return response()->json(['data' => $recommended,'html' => $html, 'recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered]);
    }


}
