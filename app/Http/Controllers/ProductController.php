<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $table = DB::table('products')
                    ->select('products.*','categories.name as name_category','brands.name as name_brand','brands.id as brand_id')
                    ->join('categories','products.categories_id','=','categories.id')
                    ->join('brands','products.categories_id','=','brands.id')
                    ->where('stok','>',0);
        
        if(isset($_GET['price'])){
            $price = $_GET['price'];
            // dd($price);
            if($price == '0-1jt'){
                $table = $table->where('price','>=',0)->where('price','<=',1000000);
                // dd($table);
            }
            if($price == '1jt-3jt'){
                $table = $table->where('price','>=',1000000)->where('price','<=',3000000);
            }

            if($price == '3jt-5jt'){
                $table = $table->where('price','>=',3000000)->where('price','<=',5000000);
            }
            if($price == '5jt-10jt'){
                $table = $table->where('price','>=',5000000)->where('price','<=',10000000);
            }
            if($price == '>10jt'){
                $table = $table->where('price','>=',10000000);
            }
        }
        if(isset($_GET['categories']) && $_GET['categories'] != ''){
            $table = $table->where('categories.name','=',$_GET['categories']);
        }
        $checkedBrand = [];
        if (isset($_GET['brand']) && $_GET['brand'] != '') {
            $checkedBrand = $_GET['brand'];
            if(gettype($checkedBrand)== 'string'){
                $checkedBrand = explode(',',$checkedBrand);   
            }else{
                $checkedBrand = $checkedBrand;
            }
            $table = $table->whereIn('brands.name',$checkedBrand);
        }
        // dd($data);
        $totalData= $table->count();
        $perPage = isset($_GET['size']) ? $_GET['size'] : 10; 
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $currentPage = $page - 1;
        $offset = ($page - 1) * $perPage;
        
        $totalPage = ceil($totalData / $perPage);
        $data = $table->offset($offset)->limit($perPage)->get();
        // dd($data);
        if(isset(Auth::user()->role) && Auth::user()->role == 'admin'){
            return view('admin.product.index',compact('data','data','totalData','page','perPage','totalPage'));
        }
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        return view('shop.index',compact('data','totalData','page','perPage','totalPage','categories','brands','checkedBrand'));
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
        $data = Product::find($id);
        $categories = DB::table('categories')->get();
        return view('shop.show',compact('data','categories')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
