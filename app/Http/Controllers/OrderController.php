<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\myOrder;
use App\Models\MyCart;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade as PDF;

class OrderController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function view(){

        $orders=DB::table('my_orders')
        ->select('my_orders.*')
        ->where('my_orders.userID','=',Auth::id())
        ->get();
        

        return view('myOrder')->with('orders',$orders);

    }

    public function pdfReport(){

        $data=DB::table('my_orders')
        ->select('my_orders.*')
        ->where('my_orders.userID','=',Auth::id())
        ->get();

        $pdf= PDF::loadView('myPDF', compact('data'));
        return $pdf->download('Order_report.pdf');
    }
}
