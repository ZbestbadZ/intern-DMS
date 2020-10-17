<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Exception;
use App\Http\Requests\UserManagementRequest;
use App\Http\Requests\EditUserManagementRequest;
use App\Http\Requests\UserIndexRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\UserHobby;
use Illuminate\Contracts\Auth\Guard;
use DB;

class UserManagementController extends Controller
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }


    public function getIndex(Request $request)
    {
        $message = $request->input('message');
        if (empty($message)) {
            return view('admin.list_user');
        }
        return redirect()->route('admin.list_user')->with('message', $message);
    }

    public function index()
    {
        $users = User::all();
        return response()->json(['data' => $users]);
    }

    public function add()
    {
        $height          = config('masterdata.height');
        $job             = config('masterdata.job');
        $figure          = config('masterdata.figure');
        $matching_expect = config('masterdata.matching_expect');
        $anual_income    = config('masterdata.anual_income');
        $holiday         = config('masterdata.holiday');
        $aca_background  = config('masterdata.aca_background');
        $alcohol         = config('masterdata.alcohol');
        $tabaco          = config('masterdata.tabaco');
        $housemate       = config('masterdata.housemate');
        $hobby           = config('masterdata.hobby');
        $birthplace      = config('masterdata.birthplace');
        return view('admin.add_user', compact(
            'figure',
            'birthplace',
            'hobby',
            'housemate',
            'job',
            'height',
            'tabaco',
            'alcohol',
            'aca_background',
            'holiday',
            'anual_income',
            'matching_expect'
        ));
    }

    public function store(UserManagementRequest $request)
    {
        $data = $request->all();
        DB::beginTransaction();
        try {
            $user = User::create($data);
            $hobbies = $request->hobby;
            if ($hobbies) {
                foreach ($hobbies as $hob) {
                    UserHobby::create([
                        'user_id' => $user->id,
                        'hobby' => $hob
                    ]);
                }
            }
            DB::commit();
            return response()->json(['success' => 'User is created successfully!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e]);
        }
    }

    public function edit(Request $request, $id)
    {
        $user            = User::find($id);
        $userHobby       = UserHobby::where('user_id', $id)->get();
        $height          = config('masterdata.height');
        $job             = config('masterdata.job');
        $figure          = config('masterdata.figure');
        $matching_expect = config('masterdata.matching_expect');
        $anual_income    = config('masterdata.anual_income');
        $holiday         = config('masterdata.holiday');
        $aca_background  = config('masterdata.aca_background');
        $alcohol         = config('masterdata.alcohol');
        $tabaco          = config('masterdata.tabaco');
        $housemate       = config('masterdata.housemate');
        $hobby           = config('masterdata.hobby');
        $birthplace      = config('masterdata.birthplace');
        $index           = $request->index;
        return view('admin.edit_user', compact(
            'user',
            'userHobby',
            'figure',
            'birthplace',
            'hobby',
            'housemate',
            'job',
            'height',
            'tabaco',
            'alcohol',
            'aca_background',
            'holiday',
            'anual_income',
            'matching_expect',
            'index'
        ));
    }

    public function update(EditUserManagementRequest $request, $id)
    {
        $user = User::with(['hobbies'])->where('id', $id)->first();
        $data = $request->all();
        try {
            $user->update($data);
            $user->hobbies()->delete();
            $hobbies = $request->hobby;
            if ($hobbies) {
                foreach ($hobbies as $hob) {
                    UserHobby::create([
                        'user_id' => $user->id,
                        'hobby' => $hob
                    ]);
                }
            }
            return response()->json(['success' => 'User is updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e]);
        }
    }

    public function show($id)
    {
        $user = User::with('hobbies')->find($id);
        $html = view('modal.message', compact('user'))->render();

        return response()->json(['user' => $user, 'html' => $html]);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json(['success' => 'User is deleted successfully!']);
    }
}