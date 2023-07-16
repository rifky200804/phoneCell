<?php

namespace App\Http\Controllers;

use App\Models\UserDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Alert;

class UserDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = UserDetail::find($id);
        return view('myProfile',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = UserDetail::find($id);
        return view('admin.user.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $userDetail = UserDetail::find($id);
        if(isset($request->full_name)){
            $userDetail->full_name = $request->full_name;
            $user = User::find($userDetail->user_id);
            $user->name = $request->full_name;
            $user->save();
        }
        if(isset($request->place_of_birth)){
            $userDetail->place_of_birth = $request->place_of_birth;
        }
        if(isset($request->date_of_birth)){
            $userDetail->date_of_birth = $request->date_of_birth;
        }
        if(isset($request->address)){
            $userDetail->address = $request->address;
        }
        if(isset($request->profile)){
            $nameFile = $request->profile."_".time();
            $userDetail->profile = $nameFile;
        }
        $userDetail->save();
        Alert::success('Success', 'Successfully Update Data');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserDetail $userDetail)
    {
        //
    }
}
