<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.dashboard');
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
