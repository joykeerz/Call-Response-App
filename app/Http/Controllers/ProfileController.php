<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('userDashboard.index');
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->tbname;
        $user->email = $request->tbemail;
        $user->password = Hash::make($request->tbpassword);
        $user->save();
        return redirect()->route('userProfile')->with('message', 'profile updated successfuly');
    }
}
