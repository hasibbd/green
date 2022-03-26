<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function showOrderList(Request $request)
    {
        $query = "SELECT b.name AS customer_name, c.name AS vendor_name, a.* FROM `order_mains` a
                LEFT JOIN `users` b ON a.created_by = b.id
                LEFT JOIN `users` c ON a.vendor_id = c.id";

        $order_lists = DB::select($query);

        return view('admin.pages.order-list.index', compact('order_lists'));
    }
}
