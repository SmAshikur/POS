<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function account(){
        return view('user.user');
    }
    public function update(Request $request){
        $user = User::find($request->id);
        $user->name=$request->name;
        $user->about=$request->about;
        $user->email=$request->email;
        if($request->hasFile('profile_image')){
            $file=$request->file('profile_image');
            $extention=$file->getClientOriginalExtension();
            $fileName=time().'.'.$extention;
            $file->move('images',$fileName);
            $user->profile_image=$fileName;
        }
        $user->save();
       // return response()->json($user);
       return redirect()->back()->with('message','profile Update Successfully');
    }
    public function passGet(){
        return view('user.pwdChange');
    }
    public function passUp(Request $request) {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            // Current password and new password same
            return redirect()->back()->with("error","New Password cannot be same as your current password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',
        ]);

        //Change Password
        $user = User::find($request->id);
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("message","Password successfully changed!");
    }

}
