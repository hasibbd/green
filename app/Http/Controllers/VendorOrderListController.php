<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\OrderMain;
use App\Models\PointWallet;
use App\Models\Setting;
use App\Models\Stock;
use App\Models\StoreManagerWallat;
use App\Models\User;
use App\Models\VendorLimit;
use App\Models\VendorProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use function PasswordCompat\binary\check;
use function Symfony\Component\Translation\t;

class VendorOrderListController extends Controller
{
    public function showSellerOrderList(Request $request)
    {
        $vendor = Auth::user();
        $query = OrderMain::with('details','customer');
        if($vendor->role == 2){
                $query->where('vendor_id', $vendor->id);
        }
        $data = $query->latest()->get();

        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<button data-order="'.$row.'"  onclick="Details('.$row->id.')" class="btn btn-sm btn-success">View</button>';

                    return $btn;
                })
                ->addColumn('customer', function($row){

                    $btn = $row->customer->name;

                    return $btn;
                })
                ->addColumn('vendor', function($row){

                    $btn = User::find($row->vendor_id);

                    return $btn->name;
                })
                ->addColumn('total_price', function($row){
                    $btn = 0;
                    foreach ($row->details as $d){
                        $btn += $d->qty*$d->price;
                    }

                    return $btn;
                })
                ->addColumn('total_point', function($row){
                    $btn = 0;
                    foreach ($row->details as $d){
                        $btn += $d->qty*$d->point;
                    }

                    return $btn;
                })
                ->addColumn('qty', function($row){
                    $btn = count($row->details);
                    return $btn;
                })
                ->addColumn('date', function($row){
                    $btn =  date("F j, Y, g:i a", strtotime($row->created_at));
                    return $btn;
                })
                ->addColumn('status', function($row){
                    if($row->status == 0){
                        return '<span class="badge badge-warning">Pending</span>';
                    }
                    else{
                        return ' <span class="badge badge-success">Success</span>';
                    }
                })
                ->rawColumns(['action','status','customer','total_price','total_point','qty','date','vendor'])
                ->make(true);
        }

        return view('admin.pages.vendor.order-list.index');
    }
    public function showSellerOrderDetailsList($id){
        $info = OrderDetail::with('vendor_details.product_details','vendor_details.product_details.brand','vendor_details.stock_details')->where('order_main_id', $id)->get();
        return response()->json([
           'message' => 'order details',
           'data' => $info
        ]);
    }
    public function ProductDeliver($id){
        $target = OrderDetail::find($id);
        $check_limit = VendorLimit::where('user_id', Auth::user()->id)->sum('limit');
        $check_products = VendorProduct::find($target->vendor_product);
        $profit = $check_products->sell_price - $check_products->vendor_price;
        $limit = $profit * $target->qty;
        if ($check_limit < $limit){
            return response()->json([
                'message' => 'Sales limit exceeded ',
                'data' => $check_limit
            ],404);
        }
       OrderDetail::find($id)->update([
            'status' => 1
        ]);
       Stock::create([
           'vendor_product' => $target->vendor_product,
           'created_by' => Auth::user()->id,
           'qty' => -$target->qty
       ]);
       VendorLimit::create([
            'user_id' => Auth::user()->id,
            'limit' => -$limit,
            'created_by' => Auth::user()->id,
        ]);
        $info = OrderDetail::with('vendor_details.product_details','vendor_details.product_details.brand','vendor_details.stock_details')->where('order_main_id', $target->order_main_id)->get();

        return response()->json([
            'message' => 'Product Delivered',
            'data' => $info
        ],200);
    }
    public function ProductDeliverAll($id){

        $target = OrderDetail::where('order_main_id', $id)->where('status', 0)->get();
        $msg = "Product Delivered";
        $icon = "success";
        foreach ($target as $t){
            $check_limit = VendorLimit::where('user_id', Auth::user()->id)->sum('limit');
            $check_products = VendorProduct::find($t->vendor_product);
            $profit = $check_products->sell_price - $check_products->vendor_price;
            $limit = $profit * $t->qty;
            if ($check_limit < $limit){
                $msg = "Sales limit exceeded";
                $icon = "error";
                break;
            }
            OrderDetail::find($t->id)->update([
                'status' => 1
            ]);
            Stock::create([
                'vendor_product' => $t->vendor_product,
                'created_by' => Auth::user()->id,
                'qty' => -$t->qty
            ]);
            VendorLimit::create([
                'user_id' => Auth::user()->id,
                'limit' => -$limit,
                'created_by' => Auth::user()->id,
            ]);
        }

        $info = OrderDetail::with('vendor_details.product_details','vendor_details.product_details.brand','vendor_details.stock_details')->where('order_main_id', $id)->get();

        return response()->json([
            'message' => $msg,
            'data' => $info,
            'icon' => $icon
        ],200);
    }
    public function ProductCancel($id){
        $target = OrderDetail::find($id);

        OrderDetail::where('id', $id)->update([
            'status' => -1
        ]);
        $info = OrderDetail::with('vendor_details.product_details','vendor_details.product_details.brand','vendor_details.stock_details')->where('order_main_id',  $target->order_main_id)->get();

        return response()->json([
            'message' => 'Product Cancel',
            'data' => $info
        ],200);
    }
    public function ProductAccept($id){
        $target = OrderDetail::find($id);
        if ($target->status == 1){
            OrderDetail::where('id', $id)->update([
                'status' =>  2
            ]);
            PointWallet::create([
               'user_id' => Auth::user()->id,
               'point' => $target->point * $target->qty,
               'generate_from' => 'Product Purchase',
               'data' => 'Order ID: '. $id
            ]);
            $this->StoreManagerPoint($target);
        }
        if ($target->status == -1){
            OrderDetail::where('id', $id)->update([
                'status' => -2
            ]);
        }
        $t_check = OrderDetail::where('order_main_id', $target->order_main_id)->get();
        if (($t_check->where('status', 2)->count() + $t_check->where('status', -2)->count()) == $t_check->count()){
            OrderMain::where('id', $target->order_main_id)->update([
                'status' => 1
            ]);
        }
        return response()->json([
            'message' => 'Product Status Accepted',
        ],200);
    }
    public function StoreManagerPoint($target){
        $rate = Setting::find(5)->point_rate;
        $check_products = VendorProduct::find($target->vendor_product);
        $profit = $check_products->sell_price - $check_products->vendor_price;
        $balance = (($profit*$rate)/100)*$target->qty;
        StoreManagerWallat::create([
            'vendor_id' => $target->vendor_id,
            'order_id' => $target->order_main_id,
            'balance' => $balance,
            'created_by' => $target->vendor_id,
            'user_id' => User::find($target->vendor_id)->reffer_by,
        ]);
    }
    public function ProductAcceptAll($id){
        $target = OrderDetail::where('order_main_id', $id)->where('status', 1)->get();
        foreach ($target as $t){
            OrderDetail::where('id', $t->id)->update([
                'status' =>  2
            ]);
            PointWallet::create([
                'user_id' => Auth::user()->id,
                'point' => $t->point * $t->qty,
                'generate_from' => 'Product Purchase',
                'data' => 'Order ID: '.$t->id
            ]);
            $this->StoreManagerPoint($t);
        }
        $t_check = OrderDetail::where('order_main_id', $id)->get();
        if (($t_check->where('status', 2)->count() + $t_check->where('status', -2)->count()) == $t_check->count()){
            OrderMain::where('id', $id)->update([
                'status' => 1
            ]);
        }
        return response()->json([
            'message' => 'Product Status Accepted',
            'icon' => 'success',
        ],200);
    }
    public function ProductAcceptAllCan($id){
        $target = OrderDetail::where('order_main_id', $id)->where('status', -1)->get();
        foreach ($target as $t){
            OrderDetail::where('id', $t->id)->update([
                'status' =>  -2
            ]);
            PointWallet::create([
                'user_id' => Auth::user()->id,
                'point' => $t->point * $t->qty,
                'generate_from' => 'Product Purchase',
                'data' => 'Order ID: '.$t->id
            ]);
        }
        $t_check = OrderDetail::where('order_main_id', $id)->get();
        if (($t_check->where('status', 2)->count() + $t_check->where('status', -2)->count()) == $t_check->count()){
            OrderMain::where('id', $id)->update([
                'status' => 1
            ]);
        }
        return response()->json([
            'message' => 'Product Status Accepted',
            'icon' => 'success',
        ],200);
    }
}
