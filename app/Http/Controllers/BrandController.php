<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Alert;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $totalData = Brand::count();

        $perPage = 10; 
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $currentPage = $page - 1;
        $offset = ($page - 1) * $perPage;
        
        $totalPage = ceil($totalData / $perPage);
        
        $data = Brand::offset($offset)->limit($perPage)->get();
        // dd($data);
        return view('admin.brand.index',compact('data','totalPage','page','totalData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            
        ]);
        $category = new Brand();
        $category->name = $request->name;
        
        $category->save();

        Alert::success('Success', 'Successfully Added Brand');
        return redirect('/admin/brand');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category  = Brand::find($id);
        $category->delete();
        Alert::success('Success', 'Successfully Delete Cart');
        return redirect('/admin/brand');
    }
}
