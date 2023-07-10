<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $myId = Auth::user()->id;
        $role = isset($_GET['role']) ? $_GET['role'] : '';
        $totalData = User::where('id','!=',$myId)->where('role','=',$role)->count();

        $perPage = 1; 
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $currentPage = $page - 1;
        $offset = ($page - 1) * $perPage;
        
        $totalPage = ceil($totalData / $perPage);
        
        $data = User::where('id','!=',$myId)->where('role','=',$role)->offset($offset)->limit($perPage)->get();

        return view('admin.user.index',compact('data','totalData','page','perPage','totalPage','role'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'full_name'=>'required',
            'email'=>'required',
            'password'=> 'required',
            'role'=>'required'
        ]);
        $user = new User();
        $user->name = $request->full_name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        $user->save();

        $userDetail = new UserDetail();
        $userDetail->name = $request->full_name;
        $userDetail->email = $request->email;
        $userDetail->user_id = $user->id;
        $user->save();
        return redirect('/admin/user?role='.$request->role);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);
        $role = $user->role;
        // dd($user);
        $data = userDetail::where('user_id','=',$user->id)->first();

        return view('admin.user.show',compact('data','role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $user = User::find($id)->first();
        $role = $user->role;
        // dd($user);
        $data = userDetail::where('user_id','=',$user->id)->first();

        return view('admin.user.edit',compact('data','role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user  = User::find($id);
        $role = $user->role;
        // dd($user);
        $user  = User::find($id);
        $user->delete();
        return redirect('/admin/user?role='.$role);
    }
}
