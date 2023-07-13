<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table('carts as a')
                ->join('products as b','a.product_id','=','b.id')
                ->select('a.*','b.name as name_product','b.price as price','b.foto as foto')
                ->where('a.user_id','=',Auth::user()->id)
                ->get();
        // dd($data);
        return view('shop.cart',compact('data'));
        
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
    public function store($id,Request $request)
    {
        $cart = new Cart();
        $cart->product_id = $id;
        $cart->user_id = Auth::user()->id;
        $cart->quantity = $request->quantity;
        $cart->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $cart = Cart::find($id);
        $cart->quantity = $request->quantity;
        $cart->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back(); 
    }
}
