<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexRequest;
use App\User;
use Illuminate\Http\Request;

class PickupController extends Controller
{
    public function getIndex()
    {
        return view('pickup.index');
    }
    public function index(IndexRequest $request)
    {
        $filter = $request->getFilter();
        $orderByParams = $request->getOrderByParameters();
        $start = $request->input('start',0);

        $usersPickup = User::getPickup($filter,$orderByParams,$start);
        $users = $usersPickup['users'];
        $recordsTotal = User::select('id','pickup_status')->where('pickup_status', PICKUP_STATUS)->count();
        $recordsFiltered = $usersPickup['recordsFiltered'];

        return response()->json(['data' => $users, 'recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered,'filter'=>$filter]);

    }
}
