<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        
        $waiting = DB::table('checkouts')->where('status','=','waiting for payment')
                    ->join('products','checkouts.product_id','=','products.id')
                    ->select('checkouts.*','products.name as name_product','products.price as price')->distinct()
                    ->orderBy('checkouts.id','DESC')
                    ->count();


        $packed = DB::table('checkouts')->where('status','=','packed')
                    ->join('products','checkouts.product_id','=','products.id')->distinct()
                    ->select('checkouts.*','products.name as name_product','products.price as price')->distinct()
                    ->orderBy('checkouts.id','DESC')
                    ->count();


        $delivery = DB::table('checkouts')->where('status','=','in delivery')
                    ->join('products','checkouts.product_id','=','products.id')->distinct()
                    ->select('checkouts.*','products.name as name_product','products.price as price')->distinct()
                    ->orderBy('checkouts.id','DESC')
                    ->count();
        
        $finished = DB::table('checkouts')->where('status','=','finished')
                    ->join('products','checkouts.product_id','=','products.id')->distinct()
                    ->select('checkouts.*','products.name as name_product','products.price as price')->distinct()
                    ->orderBy('checkouts.id','DESC')
                    ->count();
        return view('admin.dashboard',compact('waiting','packed','delivery','finished'));
    }

    public function welcome(Request $request){
        // $categories = DB::table('categories')->get();
        $queryCategoryTotal = "
                    SELECT a.name as name_category,COUNT(b.name) as total_product FROM categories as a
                    JOIN products as b ON a.id = b.categories_id
                    WHERE b.stok > 0
                    GROUP BY name_category
                    ORDER BY name_category ASC
                ";
        $categoryTotal = DB::select($queryCategoryTotal);

        $products =  Product::orderBy('id','desc')->where('stok','>',0)->limit(10)->get();
        // dd($products);
        return view('welcome',compact('categoryTotal','products'));
    }
}
