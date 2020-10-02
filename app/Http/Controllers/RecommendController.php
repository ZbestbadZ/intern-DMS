<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RecommendController extends Controller
{
    public function index() {
       
        $users = User::getRecommended();
        return response()->json(['data'=>$users]);
    }
    public function show($id) {
        $userRaw = User::find($id);
        $user = User::mapUser($userRaw);
        return response()->json(['user'=>$user]);
    }
    public function edit($id) {
        $userRaw = User::find($id);
       
        return view('recommend.edit',compact('user'));
    }
    
}
