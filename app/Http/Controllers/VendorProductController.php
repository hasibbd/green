<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Stock;
use App\Models\Unit;
use App\Models\VendorProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class VendorProductController extends Controller
{
    public function listData(Request $request){
       //$target = VendorProduct::where('created_by', auth()->user()->id)->get('id');
        $data = Product::where('status', 1);
        if ($request->brand > 0){
            $data->where('brand', $request->brand);
        }
        if ($request->category > 0){
            $data->where('category', $request->category);
        }
        $info = $data->get();
        return response()->json([
            'data' => $info
        ], 200);
    }
    public function show($id){
        $target = VendorProduct::find($id);
        return response()->json([
            'data' => $target
        ], 200);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = VendorProduct::with('stock_details','product_details','product_details.category_details','product_details.brand_details','product_details.unit_details','vendor')->where('created_by', auth::user()->id)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('photo', function ($row) {
                    return '<img style="width: 50px" src="storage/product/' . $row->product_details->photo . '">';
                })
                ->addColumn('name', function ($row) {
                    return $row->product_details->name;
                })
                ->addColumn('vendor', function ($row) {
                    return $row->vendor->name;
                })
                ->addColumn('unit', function ($row) {
                    return $row->product_details->unit_details->name;
                })
                ->addColumn('category', function ($row) {
                    return $row->product_details->category_details->title;
                })->addColumn('brand', function ($row) {
                    return $row->product_details->brand_details->title;
                })
                ->addColumn('stock', function ($row) {
                    return $row->stock_details->sum('qty');
                })->addColumn('action', function ($row) {
                    $btn = '<button class="btn btn-primary btn-sm" onclick="AddStock('.$row->id.')"><i class="fab fa-buffer"></i></button>
                            <button class="btn btn-warning btn-sm" onclick="EditModal('.$row->id.')"><i class="fas fa-edit"></i></button>
                ';

                    return $btn;
                })
                ->rawColumns(['unit', 'photo','vendor','category','brand','stock', 'action'])
                ->make(true);
        }
        $category = Category::where('status', 1)->get();
        $brand = Brand::where('status', 1)->get();
        return view('admin.pages.vendor.product.index', compact('category','brand'));
    }

    public function store(Request $request)
    {
        $check = VendorProduct::where('product', $request->products)->where('created_by', auth()->user()->id)->get();
        if (count($check) > 0){
            return response()->json([
                'data' => $check,
                'message' => 'This Product Already Added'
            ], 404);
        }
        $r_rate = Setting::find(1)->point_rate;
        $profit = $request->sell_price - $request->vendor_price;
        $g_point = ($profit-($profit*($r_rate/100)))*Setting::find(2)->point_rate;
        $check = Product::find($request->products)->is_reserve_point;
        if ($check == 1){
            $point = $g_point;
        }else{
            $point = $profit;
        }

       $st = VendorProduct::create([
            'product' => $request->products,
            'vendor_price' => $request->vendor_price,
            'sell_price' => $request->sell_price,
            'point' => $point,
            'created_by' =>  auth()->user()->id
        ]);
       if ($st){
           Stock::create([
               'vendor_product' =>$st->id,
               'created_by' => auth()->user()->id,
               'qty' =>  $request->qty
           ]);
       }

        return response()->json([
            'data' => $st,
            'message' => 'Product Added'
        ], 200);
    }
    public function price(Request $request)
    {
        $target =  VendorProduct::where('id', $request->id)->first();
        $r_rate = Setting::find(1)->point_rate;
        $profit = $request->sell_price - $request->vendor_price;
        $g_point = ($profit-($profit*($r_rate/100)))*Setting::find(2)->point_rate;
        $check = Product::find($target->product)->is_reserve_point;
        if ($check == 1){
            $point = $g_point;
        }else{
            $point = $profit;
        }
       $st = VendorProduct::where('id', $request->id)->update([
            'vendor_price' => $request->vendor_price,
            'sell_price' => $request->sell_price,
            'point' => $point
        ]);

        return response()->json([
            'data' => $st,
            'message' => 'Product price Update'
        ], 200);
    }
    public function stock(Request $request)
    {
     $st = Stock::create([
            'vendor_product' => $request->id,
            'created_by' => auth()->user()->id,
            'qty' =>  $request->qty
        ]);

        return response()->json([
            'data' => $st,
            'message' => 'Stock Added'
        ], 200);
    }
    public function pedit($id){
        $target = VendorProduct::find($id);
        return response()->json([
           'data' => $target,
            'message' => 'Product Price Updated'
        ], 200);
    }
    public function pdestroy($id){
        $target = VendorProduct::destroy($id);
        return response()->json([
           'data' => $target,
            'message' => 'Product Deleted'
        ], 200);
    }
}
