<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\User_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function register(Request $request){

        if($request->isMethod("get")){
            return view('user.register');
        }

        $request->validate([
            'name'=> 'required|max:20',
            'email'=> 'email|required|unique:users,email',
            'password'=> 'required|min:8',
            'confirm-password'=> 'required|same:password',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if($request->ajax()){
            return response()->json(['success' => true, 'message' => 'Registration successfully!']);
        }

    }

    public function login(Request $request){

        if ($request->isMethod('get')) {
            return view('user.login');
        }

        $request->validate([
            'email'=>'required','email',
            'password'=>'required',
        ]);

        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            Session::put('user_id', Auth::user()->id);
            return response()->json(['success' => true, 'message' => 'Login successfully!']);
        }

        return redirect()->route('user.login')->with('error','Invalid credintials');

    }

}
