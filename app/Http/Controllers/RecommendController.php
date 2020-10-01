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
        $user = User::find($id);
        
        return response()->json(['data'=>$user]);
    }
    public function edit($id) {
        $user = User::find($id);
        
        return view('recommend.edit',compact('user'));
    }
    
}
