<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\OrderMain;
use App\Models\PointWallet;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class VendorOrderListController extends Controller
{
    public function showSellerOrderList(Request $request)
    {
        $vendor_id = Auth::user()->id;
/*
        $query = "SELECT b.name AS customer_name, a.* FROM `order_mains` a
                LEFT JOIN `users` b ON a.created_by = b.id WHERE a.vendor_id =".$vendor_id;

        $order_lists = DB::select($query);

        return view('admin.pages.vendor.order-list.index', compact('order_lists'));*/
        $data = OrderMain::with('details','customer')->where('vendor_id', $vendor_id)->latest()->get();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<button  onclick="Details('.$row->id.')" class="btn btn-sm btn-success">View</button>';

                    return $btn;
                })
                ->addColumn('customer', function($row){

                    $btn = $row->customer->name;

                    return $btn;
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
                ->rawColumns(['action','status','customer','total_price','total_point','qty','date'])
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
       OrderDetail::find($id)->update([
            'status' => 1
        ]);
       Stock::create([
           'vendor_product' => $target->vendor_product,
           'created_by' => Auth::user()->id,
           'qty' => $target->qty
       ]);
        $info = OrderDetail::with('vendor_details.product_details','vendor_details.product_details.brand','vendor_details.stock_details')->where('order_main_id', $target->order_main_id)->get();

        return response()->json([
            'message' => 'Product Delivered',
            'data' => $info
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
        }
        if ($target->status == -1){
            OrderDetail::where('id', $id)->update([
                'status' => -2
            ]);
        }
        return response()->json([
            'message' => 'Product Status Accepted',
        ],200);
    }
}
