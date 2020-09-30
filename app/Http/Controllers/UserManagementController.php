<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Exception;
use App\Http\Requests\UserManagementRequest;
use App\Http\Requests\EditUserManagementRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use DB;

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
        return view('admin.add_user');
    }

    public function store(UserManagementRequest $request) {
        try {
            $data = $request->all();
            $user = User::create($data);
        } catch (Exception $e) {
            $mess = $e->getMessage();
            return redirect()->back()->withErrors($mess)->withInput();
        }
        return redirect()->route('admin.list_user')->with('message', 'User is created successfully!');
    }

    public function edit(Request $request, $id) {
        $user = User::find($id);
        return view('admin.edit_user', compact('user'));
    }

    public function update(EditUserManagementRequest $request, $id) {
        try {
            $user = User::find($id);
            $data = $request->all();
            $user->update($data);
            
        } catch (Exception $e) {
            $mess = $e->getMessage();
            return back()->withErrors($mess)->withInput();
        }
        return redirect()->route('admin.list_user')->with('message', 'User is updated successfully!');
    }

    public function show($id) {
        $user = User::find($id);
        return view('admin.detail_user', ['user' => $user]);
    }

    public function destroy($id) {
        $users = User::find($id);
        $users->delete();
        return response()->json(['users'=>$users]);
    }

}
