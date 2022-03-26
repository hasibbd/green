<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendorOrderListController extends Controller
{
    public function showSellerOrderList(Request $request)
    {
        return view('admin.pages.vendor.order-list.index');
    }
}
