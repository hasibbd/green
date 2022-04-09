<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VendorOrderListController extends Controller
{
    public function showSellerOrderList(Request $request)
    {
        $vendor_id = Auth::user()->id;

        $query = "SELECT b.name AS customer_name, a.* FROM `order_mains` a
                LEFT JOIN `users` b ON a.created_by = b.id WHERE a.vendor_id =".$vendor_id;

        $order_lists = DB::select($query);

        return view('admin.pages.vendor.order-list.index', compact('order_lists'));
    }
    public function showSellerOrderDetailsList($id){
        $order = OrderDetail::where('order_main_id', $id)->get();
        return view('admin.pages.vendor.order-list.details', compact('order'));

    }
}
