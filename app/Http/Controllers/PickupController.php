<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PickupController extends Controller
{
    public function getIndex() {
        return view('pickup.index');
    }
    public function index(Request $request) {
        $data = $request->only(['start','length' ,'search','order','columns']);
        
        $users  = User::getPickup($data);
        
        return response()->json(['data'=>$users]);

    }
}
