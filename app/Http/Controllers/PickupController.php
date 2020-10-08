<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PickupController extends Controller
{
    
    public function index() {
        
        $usersRaw  = User::getPickup();
        
        $users = User::mapUsers($usersRaw);
        return response()->json(['data'=>$users]);

    }
}
