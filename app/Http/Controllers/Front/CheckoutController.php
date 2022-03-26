<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Models\OrderMain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

                DB::beginTransaction();

                foreach (collect($cartData)->unique('vendor_id') as $c) {
                    $st = OrderMain::create([
                        'created_by' => auth()->user()->id,
                        'vendor_id' => $c['vendor_id'],
                        'order_id' => Str::random(10),
                        'status' => 0
                    ]);
                    if ($st) {
                        $item = [];
                        $total_price = 0;
                        $total_point = 0;
                        $total_qty = 0;
                        foreach (collect($cartData)->where('vendor_id', $c['vendor_id']) as $c) {
                            $item[] = [
                                'order_main_id' => $st->id,
                                'vendor_id' => $c['vendor_id'],
                                'vendor_product' => $c['id'],
                                'qty' => $c['quantity'],
                                'price' => $c['price'],
                                'point' => $c['point'],
                                'status' => 0
                            ];
                            $total_price += $c['price'];
                            $total_point += $c['point'];
                            $total_qty += $c['quantity'];
                        }
                        OrderDetail::insert($item);
                        OrderMain::where('id', $st->id)->update([
                            'total_price' => $total_price,
                            'total_point' => $total_point,
                            'total_qty' => $total_qty
                        ]);
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

            DB::rollBack();
        }
    }
}
