<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Exception;
use App\Http\Requests\UserManagementRequest;
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
            $data = $request->only(['name', 'username', 'email', 'password', 'sex', 'birthday', 
                                    'about', 'about_title']);
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

    public function update(Request $request, $id) {
        try {
            $user = User::find($id);
            $data = $request->only(['name', 'username', 'email', 'password', 'sex', 'birthday', 
                                    'about', 'about_title']);
            $user->update($data);
            
        } catch (Exception $e) {
            $mess = $e->getMessage();
            return back()->withErrors($mess)->withInput();
        }
        return redirect()->route('admin.list_user')->with('message', 'User is updated successfully!');
    }

    public function destroy($id) {
        $users = User::find($id);
        $users->delete();
        return response()->json(['users'=>$users]);
    }


    // public function getListUser() {
    //     $users = User::paginate(10);

    //     return view('admin.list_user', ['users' => $users]);
    // }

    // public function getAddUser() {
    //     return view('admin.add_user');
    // }

    // public function store(UserManagementRequest $request) {
    //     try {
    //         $data = $request->only(['name', 'username', 'email', 'password', 'sex', 'birthday', 
    //                                 'about', 'about_title']);
    //         $user = User::create($data);
    //     } catch (Exception $e) {
    //         $mess = $e->getMessage();
    //         return redirect()->back()->withErrors($mess)->withInput();
    //     }
    //     return redirect()->route('admin.list_user')->with('success', 'User is created successfully!');
    // }

    // public function getEditUser($id) {
    //     try {
    //         $user = $this->userModel->find($id);
    //         return view('admin.edit_user', compact('user'));
    //     } catch (Exception $e) {
    //         $mess = $e->getMessage();
    //         return redirect()->back()->withErrors($mess)->withInput();
    //     }
    // }

    // public function update(Request $request, $id) {
    //     try {
    //         $data = $request->only(['name', 'username', 'email', 'password', 'sex', 'birthday', 
    //                                 'about', 'about_title']);
    //         $user = User::where('id', $id)->update($data);
            
    //     } catch (Exception $e) {
    //         $mess = $e->getMessage();
    //         return redirect()->back()->withErrors($mess)->withInput();
    //     }
    //     return redirect()->route('admin.list_user')->with('success', 'User is updated successfully!');
    // }

    // public function deleteUser(User $id)
    // {
    //     $id->delete();
    //     return redirect()->route('admin.list_user')->with('success', 'This User is deleted successfully!');;
    // }

}
