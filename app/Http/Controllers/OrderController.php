<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function showOrderList(Request $request)
    {
        return view('admin.pages.order-list.index');
    }
}
