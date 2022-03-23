<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Models\OrderMain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function checkOut()
    {
        if (auth()->user()) {
            return view('frontend.pages.checkout.checkout');
        } else {
            return redirect()->route('/');
        }
    }

    public function storeOrder(Request $request)
    {
        try {
            if (session('cart')) {

                DB::beginTransaction();

                // store order main table data
                $orders = new OrderMain();
                $orders->created_by = Auth::user()->id;
                $orders->vendor_id = Auth::user()->id;
                $orders->order_id = rand(9999, 10000);
                $orders->status = 0;
                $orders->is_paid = 0;
                $orders->save();

                // order details data insert
                foreach (session('cart') as $cart){

                    $orderDetails = new OrderDetail();
                    $orderDetails->order_main_id = $orders->id;
                    $orderDetails->vendor_product = $cart['id'];
                    $orderDetails->qty = $cart['quantity'];
                    $orderDetails->price = $cart['price'];
                    $orderDetails->point = $cart['point'];
                    $orderDetails->status = 0;
                    $orderDetails->save();
                }

                // forget or destroy cart session
                session()->forget('cart');

                DB::commit();

                return redirect()->route('invoice.show');

//                return response()->json([
//                    'message' => 'Thank you! We have received your order.'
//                ]);
            }
        }catch (\Exception $exception){

            dd($exception);

            DB::rollBack();
        }
    }
}
