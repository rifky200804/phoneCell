<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
Use Alert;
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
                    ->join('brands','products.brand_id','=','brands.id')
                    ->where('stok','>',0);
        if (isset($_GET['price'])) {
            $price = $_GET['price'];
            // dd($price);
            if ($price == '0-1jt') {
                $table = $table->where('price', '>=', 0)->where('price', '<=', 1000000);
                // dd($table);
            }
            if ($price == '1jt-3jt') {
                $table = $table->where('price', '>=', 1000000)->where('price', '<=', 3000000);
            }

            if ($price == '3jt-5jt') {
                $table = $table->where('price', '>=', 3000000)->where('price', '<=', 5000000);
            }
            if ($price == '5jt-10jt') {
                $table = $table->where('price', '>=', 5000000)->where('price', '<=', 10000000);
            }
            if ($price == '>10jt') {
                $table = $table->where('price', '>=', 10000000);
            }
        }
        if (isset($_GET['categories']) && $_GET['categories'] != '') {
            $table = $table->where('categories.name', '=', $_GET['categories']);
        }
        $checkedBrand = [];
        if (isset($_GET['brand']) && $_GET['brand'] != '') {
            $checkedBrand = $_GET['brand'];
            if (gettype($checkedBrand) == 'string') {
                $checkedBrand = explode(',', $checkedBrand);
            } else {
                $checkedBrand = $checkedBrand;
            }
            $table = $table->whereIn('brands.name', $checkedBrand);
        }
        // dd($data);
        $totalData = $table->count();
        $perPage = isset($_GET['size']) ? $_GET['size'] : 10;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $currentPage = $page - 1;
        $offset = ($page - 1) * $perPage;

        $totalPage = ceil($totalData / $perPage);
        $data = $table->offset($offset)->limit($perPage)->get();
        // dd($data);
        if (isset(Auth::user()->role) && Auth::user()->role == 'admin') {
            return view('admin.product.index', compact('data', 'data', 'totalData', 'page', 'perPage', 'totalPage'));
        }
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        return view('shop.index', compact('data', 'totalData', 'page', 'perPage', 'totalPage', 'categories', 'brands', 'checkedBrand'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $brands = Brand::all(); // Mendapatkan semua data brand dari model Brand
        $categories = Category::all();
        return view('admin.product.create', compact('brands', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'price'=>'required',
            'stok'=>'required',
            'description'=>'required',
            'brand'=>'required',
            'category'=>'required'
        ]);
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stok = $request->stok;
        $product->description = $request->description;
        if(isset($request->foto)){
            $foto = $request->foto;
            $v_foto = time().rand(100,999).".".$foto->getClientOriginalName();
        }
        if(isset($v_foto)){
            $product->foto = $v_foto;
        }
        if(isset($foto)){
            $foto->move(public_path().'/images_product',$v_foto);
        }
        $product->brand_id = (int) $request->brand;
        $product->categories_id = $request->category;        
        // dd($product);
        $product->save();

        Alert::success('Success', 'Successfully Added Product');

        return redirect('/admin/product');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = DB::table('products')
        ->select('products.*','categories.name as name_category','brands.name as name_brand','brands.id as brand_id')
        ->join('categories','products.categories_id','=','categories.id')
        ->join('brands','products.categories_id','=','brands.id')
        ->where('products.id','=',$id)->first();
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        // dd($data);
        return view('shop.show', compact('data', 'categories','brands'));
    }

    public function showAdmin($id){
        $data = DB::table('products')
        ->select('products.*','categories.name as name_category','brands.name as name_brand','brands.id as brand_id')
        ->join('categories','products.categories_id','=','categories.id')
        ->join('brands','products.categories_id','=','brands.id')
        ->where('products.id','=',$id)->first();
        // dd($data);
        return view('admin.product.show', compact('data'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = DB::table('products')
        ->select('products.*','categories.name as name_category','brands.name as name_brand','brands.id as brand_id')
        ->join('categories','products.categories_id','=','categories.id')
        ->join('brands','products.categories_id','=','brands.id')
        ->where('products.id','=',$id)->first();
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        return view('admin.product.edit', compact('data', 'categories','brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stok = $request->stok;
        $product->description = $request->description;
        if(isset($request->foto)){
            $foto = $request->foto;
            $v_foto = time().rand(100,999).".".$foto->getClientOriginalName();
        }
        if(isset($v_foto)){
            $product->foto = $v_foto;
        }
        if(isset($foto)){
            $foto->move(public_path().'/images_product',$v_foto);
        }
        $product->brand_id = (int) $request->brand;
        $product->categories_id = $request->category;

        // dd($product);
        $product->save();
        Alert::success('Success', 'Successfully Update Product');

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product  = Product::find($id);
        $product->delete();
        Alert::success('Success', 'Successfully Deleted Product');
        
        return redirect('/admin/product');
    }
}
