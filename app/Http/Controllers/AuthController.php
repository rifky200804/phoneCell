<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class AuthController extends Controller
{
    public function login($role,Request $request){
        if($role == 'admin'){
            return view('admin.login');
        }else{
            return view('auth.login');
        }
    }
    public function postlogin($role,Request $request){
        $this->validate($request,[
            'email'=>'required',
            'password'=>'required'
        ]);
        if($role == 'user'){
            $role = 'pelanggan';
        }
        $user = DB::table('users')->where('role','=',$role)->where('email','=',$request->email)->first();
        // dd($user);
        if($user == null){
            return redirect()->route('login',$role)->with('errorMessage','Failed To Login');
        }
        if(Auth::attempt($request->only('email','password'))){
            if($role == 'admin'){
                return redirect()->route('admin.dashboard');
            }else{
                return redirect()->route('welcome');
            }
        }else{
            return back();
        }
    }
    public function logout(){
        $role = Auth::user()->role;
        Auth::logout();
        if($role == 'admin'){
            return redirect('/admin/login');
        }
        return redirect()->route('welcome');
    }

    public function register(){
            return view('auth.register');
    }
}
