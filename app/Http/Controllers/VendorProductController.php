<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use App\Models\VendorProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class VendorProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::with('category', 'brand', 'unit')->where('status', '=', 1)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-primary btn-sm" onclick="addProductForVendor(' . $row->id . ')"><i class="fas fa-plus-circle"></i></button>';
                })
                ->addColumn('photo', function ($row) {
                    return '<img style="width: 50px" src="storage/product/' . $row->photo . '">';
                })
                ->rawColumns(['action', 'photo'])
                ->make(true);
        }
        return view('admin.pages.vendor.product.index');
    }

    public function myProductShow(Request $request)
    {
        $vendor_id = Auth::user()->id;
        if ($request->ajax()) {
            $query = "SELECT c.title AS category_name, d.title AS brand_name, e.name AS unit_name, b.name AS p_name, b.photo as p_photo, b.short_detail AS p_detail, a.vendor_price, a.sell_price, a.id FROM `vendor_products` a
                    LEFT JOIN `products` b ON a.product = b.id
                    LEFT JOIN `categories` c ON b.category = c.id
                    LEFT JOIN `brands` d ON b.brand = d.id
                    LEFT JOIN `units` e ON b.unit = e.id
                    WHERE a.created_by =" . $vendor_id;

            $data = DB::select($query);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('photo', function ($row) {
                    return '<img style="width: 50px" src="storage/product/' . $row->p_photo . '">';
                })
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-warning btn-sm" onclick="addProductForVendor(' . $row->id . ')"><i class="fas fa-file-invoice-dollar"></i></button>
                            <button class="btn btn-danger btn-sm" onclick="RemoveProductForVendor(' . $row->id . ')"><i class="fas fa-trash"></i></button>';
                })
                ->rawColumns(['photo','action'])
                ->make(true);
        }
        return view('admin.pages.vendor.my_product.index');
    }

    public function store(Request $request)
    {
        if ($request->product_id) {

            $v_product = new VendorProduct();
            $v_product->product = $request->product_id;
            $v_product->vendor_price = $request->vendor_price;
            $v_product->sell_price = $request->sell_price;
            $v_product->point = $request->sell_price - $request->vendor_price;
            $v_product->created_by = Auth::user()->id;

            if ($v_product->save()) {
                return response()->json([
                    'message' => 'Data successfully saved.',
                ], 200);
            }
        } else {
            return response()->json([
                'message' => 'Something Error Found, Please try again.',
            ], 500);
        }
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
