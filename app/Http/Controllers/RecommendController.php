<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RecommendController extends Controller
{
    public function indexView() {
        return view('recommend.index');
    }
    
    public function index(Request $request) {
        $data = $request->only(['columns','order','start','search']);
        $users = User::getRecommended($data);
        
        return response()->json(['data'=>$users]);
    }

    public function show($id) {
        $userRaw = User::find($id);

        if(empty($userRaw)) {
            return abort(404);
        }

        $user = User::mapUser($userRaw);

        return response()->json(['user'=>$user]);
    }
   
}
