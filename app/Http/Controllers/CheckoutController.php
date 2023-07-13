<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CheckoutController extends Controller
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
        $myId = Auth::user()->id;
        $cart = Cart::where('user_id','=',$myId);
        $getCart = $cart->get();
        $processCode = time();
        dd($getCart,$processCode);
        foreach($getCart as $item => $value){
            $checkout = new Checkout();
            $checkout->processCode = $processCode;
            $checkout->shipping = $request->shipping;
            $checkout->subTotal = $request->subTotal;
            $checkout->product_id = $value->product_id;
            $checkout->user_id = $myId;
            $checkout->status = 'Menunggu Pembayaran';
            $checkout->save();
        }
        return redirect()->route('welcome');
        
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
