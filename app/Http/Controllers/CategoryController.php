<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalData = Category::count();

        $perPage = 10; 
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        // dd($page);
        $currentPage = $page - 1;
        $offset = ($page - 1) * $perPage;
        
        $totalPage = ceil($totalData / $perPage);
        
        $data = Category::offset($offset)->limit($perPage)->get();
        // dd($data);
        return view('admin.category.index',compact('data','totalPage','page','totalData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            
        ]);
        $category = new Category();
        $category->name = $request->name;
        
        $category->save();

        
        return redirect('/admin/category');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category  = Category::find($id);
        $category->delete();
        
        return redirect('/admin/category');
    }
}
