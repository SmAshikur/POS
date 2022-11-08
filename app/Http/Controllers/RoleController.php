<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function index(){
        $user = User::get()->all();
        return view('role.userlist',compact('user'));
    }
    public function edit($id){
        $user = User::find($id);
        return response()->json($user);
    }
    public function update(Request $request,$id){
        $user = User::find($id);
        if(Auth::user()->id==$id && Auth::user()->role=='admin'){
            $msg='0';
            return response()->json($msg);
        }else{
            $user->role= $request->role;
            //$user->name= $request->name;
            $user->update();
            return response()->json($user);
            return redirect()->back();
        }

      //  return redirect()->back()->with('message','update successfully');
    }
    public function destroy(Request $request,$id){
        $user = User::find($id);
        if(Auth::user()->id==$id ){
            return redirect()->back()->with('error','You cant Delete your own');
        }else{
            $user->delete();
            return redirect()->back()->with('message','delete successfully');
        }

    }
}
