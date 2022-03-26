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
                $cartData = session('cart');

                $total_price = 0;
                $total_point = 0;
                $total_qty = 0;

                $order_data_array = [];
                $unique_vendor_Array = [];
                $vendor_Array = [];


                DB::beginTransaction();

                foreach ($cartData as $data) {

                    $vendor_Array[] = $data['vendor_id'];
                    $order_data_array[] = $data;

                    $total_point += $data['point'];
                    $total_price += $data['price'];
                    $total_qty += $data['quantity'];
                }

                $unique_vendor_Array[] = array_unique($vendor_Array);

//                dd($order_data_array, $unique_vendor_Array);

                for ($i = 0; $i < $unique_vendor_Array; $i++) {

                    $orders = new OrderMain();
                    $orders->created_by = Auth::user()->id;
                    $orders->vendor_id = 1;
                    $orders->total_point = $total_point;
                    $orders->total_price = $total_price;
                    $orders->total_qty = $total_qty;
                    $orders->order_id = rand(9999, 10000);
                    $orders->status = 0;
                    $orders->is_paid = 0;
                    $orders->save();

                    for ($j = 0; $j < $order_data_array; $j++) {

//                        dd($unique_vendor_Array[$i][0] == $order_data_array[$j]['vendor_id']);
//                        dd($order_data_array[$j]['vendor_id']);


                        if ($unique_vendor_Array[$i][0] != $order_data_array[$j]['vendor_id']) {

                            // dd($order_data_array[$j]);
                            $orderDetails = new OrderDetail();
                            $orderDetails->order_main_id = $orders->id;
                            $orderDetails->vendor_product = $order_data_array[$j]['id'];
                            $orderDetails->vendor_id = $order_data_array[$j]['vendor_id'];
                            $orderDetails->qty = $order_data_array[$j]['quantity'];
                            $orderDetails->price = $order_data_array[$j]['price'];
                            $orderDetails->point = $order_data_array[$j]['point'];
                            $orderDetails->status = 0;
                            $orderDetails->save();

                        }
                    }
                }

                // forget or destroy cart session
                session()->forget('cart');

                DB::commit();

                return redirect()->route('invoice.show');

//                return response()->json([
//                    'message' => 'Thank you! We have received your order.'
//                ]);
            }
        } catch (\Exception $exception) {

            dd($exception);

            DB::rollBack();
        }
    }
}
