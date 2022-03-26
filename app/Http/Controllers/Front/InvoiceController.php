<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function invoiceShow()
    {
        if (auth()->user()) {

            $user_id = Auth::user()->id;

//            $query = "SELECT b.name AS customer_name, a.* FROM `order_mains` a
//                LEFT JOIN `users` b ON a.created_by = b.id WHERE a.created_by =".$user_id;
//
//            $order_lists = DB::select($query);
            $orders = DB::table('order_mains')->where('created_by','=',$user_id)->get();

//            dd($orders);

            return view('frontend.pages.invoice.invoice');
        } else {
            return redirect()->route('/');
        }
    }
}
