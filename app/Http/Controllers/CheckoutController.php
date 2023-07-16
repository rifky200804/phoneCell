<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;
use App\Models\UserDetail;
use Illuminate\Support\Facades\DB;
use Alert;
class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $processCodeWaiting =  DB::table('checkouts')->where('status','=','waiting for payment')
                    ->where('user_id','=',Auth::user()->id)    
                    ->join('products','checkouts.product_id','=','products.id')
                    ->select('checkouts.processCode','checkouts.subTotal','checkouts.shipping')->distinct()
                    ->orderBy('checkouts.id','DESC')
                    ->get();
        // dd($processCodeWaiting);
        
        $waiting = DB::table('checkouts')->where('status','=','waiting for payment')
                    ->where('user_id','=',Auth::user()->id)
                    ->join('products','checkouts.product_id','=','products.id')
                    ->select('checkouts.*','products.name as name_product','products.price as price')->distinct()
                    ->orderBy('checkouts.id','DESC')
                    ->get();

        $processCodePacked =  DB::table('checkouts')->where('status','=','packed')
                    ->where('user_id','=',Auth::user()->id)    
                    ->join('products','checkouts.product_id','=','products.id')->distinct()
                    ->select('checkouts.processCode','checkouts.subTotal','checkouts.shipping')
                    ->orderBy('checkouts.id','DESC')
                    ->get();

        $packed = DB::table('checkouts')->where('status','=','packed')
                    ->where('user_id','=',Auth::user()->id)
                    ->join('products','checkouts.product_id','=','products.id')->distinct()
                    ->select('checkouts.*','products.name as name_product','products.price as price')->distinct()
                    ->orderBy('checkouts.id','DESC')
                    ->get();


        $processCodeDelivery =  DB::table('checkouts')->where('status','=','in Delivery')
                    ->where('user_id','=',Auth::user()->id)    
                    ->join('products','checkouts.product_id','=','products.id')->distinct()
                    ->select('checkouts.processCode','checkouts.subTotal','checkouts.shipping')
                    ->orderBy('checkouts.id','DESC')
                    ->get();
        $delivery = DB::table('checkouts')->where('status','=','in delivery')
                    ->where('user_id','=',Auth::user()->id)
                    ->join('products','checkouts.product_id','=','products.id')->distinct()
                    ->select('checkouts.*','products.name as name_product','products.price as price')->distinct()
                    ->orderBy('checkouts.id','DESC')
                    ->get();
        
        $processCodeFinished =  DB::table('checkouts')->where('status','=','finished')
                    ->where('user_id','=',Auth::user()->id)    
                    ->join('products','checkouts.product_id','=','products.id')->distinct()
                    ->select('checkouts.processCode','checkouts.subTotal','checkouts.shipping')
                    ->orderBy('checkouts.id','DESC')
                    ->get();
        $finished = DB::table('checkouts')->where('status','=','finished')
                    ->where('user_id','=',Auth::user()->id)
                    ->join('products','checkouts.product_id','=','products.id')->distinct()
                    ->select('checkouts.*','products.name as name_product','products.price as price')->distinct()
                    ->orderBy('checkouts.id','DESC')
                    ->get();
        return view(
            'shop.order',
            compact(
                'waiting','processCodeWaiting',
                'packed','processCodePacked',
                'delivery','processCodeDelivery',
                'finished','processCodeFinished'
            )
        );
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
        // dd($userDetail);
        if($userDetail->address == 'null' || $userDetail->address == ''){
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
            $product = Product::find($value->product_id);
            // dd($product);
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
        Alert::success('Success', 'Successfully Checkout');
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
