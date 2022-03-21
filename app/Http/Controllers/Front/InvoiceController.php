<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function invoiceShow()
    {
        if (auth()->user()) {
            return view('frontend.pages.invoice.invoice');
        } else {
            return redirect()->route('/');
        }
    }
}
