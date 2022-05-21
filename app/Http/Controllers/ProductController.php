<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Unit;
use App\Models\VendorProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::with('category','brand','unit')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<button class="btn btn-primary btn-sm" onclick="Status('.$row->id.')"><i class="fas fa-sync-alt"></i></button>
                            <button class="btn btn-warning btn-sm" onclick="Show('.$row->id.')"><i class="fas fa-pen-square"></i></button>
                            <button class="btn btn-danger btn-sm" onclick="Delete('.$row->id.')"><i class="fas fa-trash"></i></button>';

                    return $btn;
                })
                ->addColumn('status', function($row){
                    if ($row->status == 1){
                        $btn = '<span class="badge badge-pill badge-primary">Active</span>';

                    }else{
                        $btn = '<span class="badge badge-pill badge-danger">Disabled</span>';

                    }
                    return $btn;
                })
                ->addColumn('reserve', function($row){
                    if ($row->is_reserve_point == 1){
                        $btn = '<span class="badge badge-pill badge-primary">Active</span>';

                    }else{
                        $btn = '<span class="badge badge-pill badge-danger">Disabled</span>';

                    }
                    return $btn;
                })
                ->addColumn('photo', function($row){
                    return '<img style="width: 40px; border-radius: 50%" src="storage/product/'.$row->photo.'">';
                })
                ->rawColumns(['action', 'status', 'photo','reserve'])
                ->make(true);
        }
        $units = Unit::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        return view('admin.pages.product.index', compact('units','brands','categories'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if ($request->r_wallet){
            $r = 1;
        }else{
            $r = 0;
        }
        if($request->hasfile('photo'))
        {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().Str::random(5).'.'.$extension;
            $resize = Image::make($file)->resize(450, 450)->encode($extension);
            $save = Storage::put("public/product/".$filename, $resize->__toString());
            Product::updateOrCreate([
                    'id' => $request->id
                ]
                ,[
                    'photo' => $filename,
                    'name' => $request->title,
                    'short_detail' => $request->short_detail,
                    'detail' => $request->detail,
                    'category' => $request->category,
                    'brand' => $request->brand,
                    'unit' => $request->unit,
                    'is_reserve_point' => $r,
                    'reserve_point_amount' => $request->r_amount,
                    'status' => 1,
                ]);
        }else{
            if ($request->id){
                $target = Product::find($request->id)->photo;
            }else{
                $target = 'default.png';
            }
            Product::updateOrCreate([
                    'id' => $request->id
                ]
                ,[
                    'photo' => $target,
                    'name' => $request->title,
                    'short_detail' => $request->short_detail,
                    'detail' => $request->detail,
                    'category' => $request->category,
                    'brand' => $request->brand,
                    'unit' => $request->unit,
                    'is_reserve_point' => $r,
                    'reserve_point_amount' => $request->r_amount,
                    'status' => 1,
                ]);
        }
        if ($request->id){

            $m = 'Product Updated';
            $t_vendor = VendorProduct::where('product', $request->id)->get();
            foreach ($t_vendor as $t){
                $point_rate = Setting::find(2)->point_rate;
                $profit = $t->sell_price - $t->vendor_price;
                $g_point = $profit - (($profit*$request->r_amount)/100);
                if ($r == 1){
                    VendorProduct::where('id', $t->id)->update([
                        'point' => $g_point*$point_rate
                    ]);
                }else{
                    VendorProduct::where('id', $t->id)->update([
                        'point' => $profit*$point_rate
                    ]);
                }
            }

        }else{
            $m = 'New Product Created';
        }
        return response()->json([
            'message' => $m
        ], 200);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function status($id)
    {
        $data = Product::find($id);
        if ($data->status){
            $data = Product::where('id', $id)->update([
                'status' => false
            ]);
            return response()->json([
                'message' => 'Data status update to disabled',
                'data' => $data
            ],200);
        }else{
            $data = Product::where('id', $id)->update([
                'status' => true
            ]);
            return response()->json([
                'message' => 'Data status update to enable',
                'data' => $data
            ],200);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $data = Product::find($id);
        if ($data){
            return response()->json([
                'message' => 'Data Found',
                'data' => $data
            ],200);
        }else{
            return response()->json([
                'message' => 'Data not found',
                'data' => $data
            ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return response()->json([
            'message' => 'Data deleted',
            'data' =>[]
        ],202);
    }
}
