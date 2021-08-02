<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\isEmpty;

class ProfileController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();
        return view('userDashboard.index', ['users' => $users]);
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->tbname;
        $user->email = $request->tbemail;
        if (!isEmpty($user->password)) {
            $user->password = Hash::make($request->tbpassword);
        }
        $user->save();
        return redirect()->route('userProfile')->with('message', 'profile updated successfuly');
    }

    public function createUser(Request $request)
    {
        $user = new User;
        $user->name = $request->tbNewName;
        $user->email = $request->tbNewEmail;
        $user->password = Hash::make($request->tbNewPassword);
        $user->level = $request->cbNewRole;
        $user->save();
        return redirect()->route('userProfile')->with('message', 'user created successfuly');
    }

    public function editUser($id)
    {
        $data = User::find($id);
        return response()->json($data);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->tbEditName;
        $user->email = $request->tbEditEmail;
        if (!isEmpty($request->tbEditPassword)) {
            $user->password = Hash::make($request->tbEditPassword);
        }
        $user->level = $request->cbEditRole;
        $user->save();
        return redirect()->route('userProfile')->with('message', 'user updated successfuly');
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('userProfile')->with('message', 'user deleted successfuly');
    }
}
