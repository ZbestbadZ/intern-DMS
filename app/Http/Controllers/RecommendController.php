<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecommendIndexRequest;
use App\User;
use Illuminate\Http\Request;


class RecommendController extends Controller
{
    public function indexView(Request $request)
    {
        $message = $request->input('message');
        if(empty($message)) {
            return view('recommend.index');
        }
        return redirect()->route('recommend.index')->with('message', $message);
        
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
        
        return response()->json(['data' => $recommended, 'recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered]);
    }


}
