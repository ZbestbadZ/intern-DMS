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
        $recordsTotal = User::count();
        $recordsFiltered = User::where('pickup_status', config('const.PICKUP_STANDARD.PICKUP_STATUS'))->count();

        return response()->json(['data' => $users, 'recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered]);

    }
}
