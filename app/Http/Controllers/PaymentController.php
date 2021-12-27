<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\myOrder;
use App\Models\MyCart;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function paymentPost(Request $request)
    {
	       
	Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => $request->sub*100, //RM 10 10=10 can 10*100=10000 can
                "currency" => "MYR",
                "source" => $request->stripeToken,
                "description" => "This payment is testing purpose of southern online",
        ]);

        $newOrder=myOrder::create([

            'paymentStatus' =>'Done', 
            'userID' => Auth::id(),
            'amount' => $request->sub,

        ]);

        $orderID=DB::table('my_orders')->where('userID','=',Auth::id())->orderBy('created_at','desc')->first(); //get the order id jast now created

        $items=$request->input('cid');
        foreach($items as $item=>$value){
            $carts=myCart::find($value);  //get the cart item record
            $carts->orderID=$orderID->id;  //binding the orderId value with record
            $carts->save();
        }
           
        return back();
    }

}
