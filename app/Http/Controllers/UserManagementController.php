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
use Illuminate\Contracts\Auth\Guard;

class UserManagementController extends Controller
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }


    public function getIndex(Request $request) {
        $message = $request->input('message');
        if(empty($message)) {
            return view('admin.list_user');
        }
        return redirect()->route('admin.index')->with('message', $message);
    }

    public function index() {
        $users = User::all();
        if(empty($users)) {
            return abort(404);
        }

        $users = User::mapUsers($users);
        return response()->json(['data'=>$users]);
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

            $hobby = $request->hobby;
            if ($request->has('hobby')) {
                foreach ($hobby as $hob) { 
                    UserHobby::create([
                        'user_id' => $user->id,
                        'hobby' => $hob
                    ]);
                }
            }
            
        } catch (Exception $e) {
            return abort(500);
        }  
        return response()->json(['success'=>'User is created successfully!']);
    }

    public function edit(Request $request, $id) {
        $user = User::find($id);
        if(empty($user)) {
            return abort(404);
        }
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

    public function update(EditUserManagementRequest $request, $id) {
        $user = User::find($id);
        if (empty($user)) {
            return abort(404);
        }

        $data = $request->all();
        $user->update($data);
        try {
           
            $hobbies = UserHobby::where('user_id', $id)->get();
            if (UserHobby::exists($hobbies)) {
                UserHobby::delete($hobbies);
            }
            $hobby = $request->hobby;
            if ($request->has('hobby')) {               
                foreach ($hobby as $hob) { 
                    UserHobby::create([
                        'user_id' => $user->id,
                        'hobby' => $hob
                    ]); 
                }
            }
        } catch (Exception $e) {
            return abort(500);
        }
        return response()->json(['success' => 'User is updated successfully!']);
    }

    public function show($id) {
        $userRaw = User::find($id);
        if(empty($userRaw)) {
            return abort(404);
        }

        $user = User::mapUser($userRaw);
        $userHobby = new User();
        $hobby = $userHobby->getHobbiesParsed($id);
        return response()->json(['user'=>$user, 'hobby'=>$hobby]);
    }

    public function destroy($id) {
        $user = User::find($id);
        if(empty($user)) {
            return abort(404);
        } 
        $user->delete();
    }

}
