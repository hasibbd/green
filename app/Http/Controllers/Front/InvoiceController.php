<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\OrderMain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function invoiceShow()
    {
        if (auth()->user()) {

            $user_id = Auth::user()->id;
            $orders =OrderMain::with('details','vendor','product_details')->latest()->first();
            return view('frontend.pages.invoice.invoice', compact('orders'));
        } else {
            return redirect()->route('/');
        }
    }
    public function orderShow(){
        $orders = OrderMain::with('vendor','details','details.product_details','details.vendor_details','details.vendor_details.product_details.unit_details','details.vendor_details.product_details.brand_details')->where('created_by',Auth::user()->id)->paginate();
        return view('frontend.pages.order.index', compact('orders'));
    }
}
