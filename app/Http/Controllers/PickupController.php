<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexRequest;
use App\Http\Requests\PickupIndexRequest;
use App\User;
use Illuminate\Http\Request;

class PickupController extends Controller
{
    public function getIndex(Request $request)
    {
        $message = $request->input('message');
        if(empty($message)) {
            return view('pickup.index');
        }
        return redirect()->route('pickup.index')->with('message', $message);
        
    }
    public function index(PickupIndexRequest $request)
    {
        $filter = $request->getFilter();
        $orderByParams = $request->getOrderByParameters();
        $start = $request->input('start',0);

        $usersPickup = User::getPickup($filter,$orderByParams,$start);
        $users = $usersPickup['users'];
        $recordsTotal = $usersPickup['recordsTotal'];
        $recordsFiltered = $usersPickup['recordsFiltered'];
        return response()->json(['data' => $users, 'recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered]);

    }
}
