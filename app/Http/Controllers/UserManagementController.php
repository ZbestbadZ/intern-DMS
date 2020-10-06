<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Exception;
use App\Http\Requests\UserManagementRequest;
use App\Http\Requests\EditUserManagementRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\UserHobby;

class UserManagementController extends Controller
{
    protected $userModel;

    public function __construct(User $model) {
        $this->userModel = $model;
    }

    public function index() {
        $users = User::all();
        return response()->json(['data'=>$users]);
    }
    
    public function add() {
        $height = config('masterdata.height');
        $job = config('masterdata.job');
        $figure = config('masterdata.figure');
        $matching_expect = config('masterdata.matching_expect');
        $anual_income = config('masterdata.anual_income');
        $holiday = config('masterdata.holiday');
        $aca_background = config('masterdata.aca_background');
        $alcohol = config('masterdata.alcohol');
        $tabaco = config('masterdata.tabaco');
        $housemate = config('masterdata.housemate');
        $hobby = config('masterdata.hobby');
        $birthplace = config('masterdata.birthplace');
        return view('admin.add_user', compact('figure', 'birthplace', 'hobby', 'housemate', 'job', 'height', 
                'tabaco', 'alcohol', 'aca_background', 'holiday', 'anual_income', 'matching_expect'));
    }

    public function store(UserManagementRequest $request) {
        try {
            $data = $request->all();
            $user = User::create($data);
            UserHobby::create([
                'user_id' => $user->id,
                'hobby' => $request->hobby,
            ]);
        } catch (Exception $e) {
            $mess = $e->getMessage();
            return redirect()->back()->withErrors($mess)->withInput();
        }
        return redirect()->route('admin.list_user')->with('message', 'User is created successfully!');
    }

    public function edit(Request $request, $id) {
        $user = User::find($id);
        $userHobby = UserHobby::where('user_id', $user->id)->first();
        $user_hobby = $user->hobbies;
        $height = config('masterdata.height');
        $job = config('masterdata.job');
        $figure = config('masterdata.figure');
        $matching_expect = config('masterdata.matching_expect');
        $anual_income = config('masterdata.anual_income');
        $holiday = config('masterdata.holiday');
        $aca_background = config('masterdata.aca_background');
        $alcohol = config('masterdata.alcohol');
        $tabaco = config('masterdata.tabaco');
        $housemate = config('masterdata.housemate');
        $hobby = config('masterdata.hobby');
        $birthplace = config('masterdata.birthplace');
        return view('admin.edit_user', compact('user','user_hobby', 'userHobby', 'figure', 'birthplace', 'hobby', 'housemate', 'job', 'height', 
        'tabaco', 'alcohol', 'aca_background', 'holiday', 'anual_income', 'matching_expect'));
    }

    public function getMaleOption() {
        $hobbies = config('masterdata.hobby');
        $height = config('masterdata.height');
        $job = config('masterdata.job');
        $figure = config('masterdata.figure');
        $matching_expect = config('masterdata.matching_expect');
        $anual_income = config('masterdata.anual_income');
        $holiday = config('masterdata.holiday');
        $aca_background = config('masterdata.aca_background');
        $alcohol = config('masterdata.alcohol');
        $tabaco = config('masterdata.tabaco');
        $housemate = config('masterdata.housemate');
        
        $birthplace = config('masterdata.birthplace');
        return response()->json([
            'hobbies' => $hobbies,
            'height' => $height,
            'job' => $job,
            'figure' => $figure,
            'matching_expect' => $matching_expect,
            'anual_income' => $anual_income,
            'holiday' => $holiday,
            'aca_background' => $aca_background,
            'alcohol' => $alcohol,
            'tabaco' => $tabaco,
            'housemate' => $housemate
        ]);
    }

    public function update(EditUserManagementRequest $request, $id) {
        try {
            $user = User::find($id);
            $userHobby = UserHobby::where('user_id', $user->id)->first();
            if ($userHobby == null) {
                return abort(404);
            }
    
            $data = $request->all();
            $user->update($data);
            $userHobby->create([
                'user_id' => $user->id,
                'hobby' => $request->hobby,
            ]);
            
            
        } catch (Exception $e) {
            $mess = $e->getMessage();
            return back()->withErrors($mess)->withInput();
        }
        return redirect()->route('admin.list_user')->with('message', 'User is updated successfully!');
    }

    public function show($id) {
        $userRaw = User::find($id);
        if($userRaw === null) {
            return abort(404);
        }

        $user = User::mapUser($userRaw);
        

        return response()->json(['user'=>$user]);
    }

    public function destroy($id) {
        $user = User::find($id);
        if($user === null) return abort(404);
        $user->delete();
        return response()->json(['user'=>$user]);
    }

}
