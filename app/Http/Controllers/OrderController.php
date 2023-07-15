<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Checkout;
use Alert;

class OrderController extends Controller
{
    public function index(){
        if(isset($_GET['status'])){
            $status = $_GET['status'];
            $status = "'$status'";
        }else{
            $status = "'waiting for payment'";
        }
        

        $query = "SELECT c.name as name_customer,SUM(a.quantity) as total_product,(a.subTotal + a.shipping) as total_price,a.processCode as processCode,status 
                    FROM checkouts as a
                    JOIN products as b ON a.product_id = b.id
                    JOIN users as c ON a.user_id = c.id
                    WHERE a.status = ".$status.
                    " GROUP BY processCode,name_customer,total_price,status
                    ORDER BY processCode ASC";
        $data = DB::select($query);
        // dd($data);
        return view('admin.order.index',compact('data'));
    }
    public function update(Request $request){
        // dd($request->all());
        $orders = Checkout::where('processCode','=',$request->processCode)->get();
        // dd($orders);
        foreach ($orders as $key => $value) {
            $update = Checkout::find($value->id);
            $update->status =  $request->status;
            $update->save();
        }
        Alert::success('Success', 'Successfully Update Status');
        return redirect('/admin/order?status='.$request->status);
    }
}
