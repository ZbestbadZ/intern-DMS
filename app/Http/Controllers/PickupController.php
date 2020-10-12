<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class PickupController extends Controller
{
    public function getIndex()
    {
        return view('pickup.index');
    }
    public function index(Request $request)
    {
        $data = $request->only(['start', 'length', 'search', 'order', 'columns']);

        $users = User::getPickup($data);
        $recordsTotal = User::where('pickup_status', PICKUP_STATUS)->count();
        $recordsFiltered = User::where('pickup_status', PICKUP_STATUS)->count();

        return response()->json(['data' => $users, 'recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered]);

    }
}
