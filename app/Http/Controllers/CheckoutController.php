<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;
use App\Models\UserDetail;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $waiting = DB::table('checkouts')->where('status','=','waiting for payment')
                    ->join('products','checkouts.product_id','=','products.id')
                    ->select('checkouts.*','products.name as name_product','products.price as price')
                    ->orderBy('id','DESC')
                    ->get();
        $packed = DB::table('checkouts')->where('status','=','packed')
                    ->join('products','checkouts.product_id','=','products.id')
                    ->select('checkouts.*','products.name as name_product','products.price as price')
                    ->orderBy('id','DESC')
                    ->get();
        $delivery = DB::table('checkouts')->where('status','=','in delivery')
                    ->join('products','checkouts.product_id','=','products.id')
                    ->select('checkouts.*','products.name as name_product','products.price as price')
                    ->orderBy('id','DESC')
                    ->get();
        $finished = DB::table('checkouts')->where('status','=','finished')
                    ->join('products','checkouts.product_id','=','products.id')
                    ->select('checkouts.*','products.name as name_product','products.price as price')
                    ->orderBy('id','DESC')
                    ->get();
        return view('shop.order',compact('waiting','packed','delivery','finished'));
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
        $myId = Auth::user()->id;
        $userDetail = UserDetail::where('user_id','=',$myId)->first();
        if($userDetail->address == null || $userDetail->address == ''){
            return redirect()->route('myProfile',$userDetail->id);
        }
        // dd($userDetail);
        $cart = Cart::where('user_id','=',$myId);
        $getCart = $cart->get();
        // dd($getCart);
        $processCode = time();
        foreach($getCart as $item => $value){
            $cartById = Cart::find($value->id);
            // pengurangan sisa stok
            $product = Product::find($value->id);
            $product->stok = $product->stok - $cartById->quantity;
            $product->save();
            // save to table schekout
            $checkout = new Checkout();
            $checkout->processCode = $processCode;
            $checkout->shipping = $request->shipping;
            $checkout->subTotal = $request->subTotal;
            $checkout->product_id = $value->product_id;
            $checkout->quantity = $value->quantity;
            $checkout->user_id = $myId;
            $checkout->status = 'Waiting for payment';
            $checkout->save();
        }
        $cart->delete();
        return redirect()->route('order');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Checkout $checkout)
    {
        //
    }
}
