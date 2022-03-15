<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\VendorProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $sliders = Slider::where('status', 1)->get();
        $brands = Brand::with('product')->where('status', 1)->get();
        $categories = Category::with('product')->where('status', 1)->get();
        $articles = Article::with('creator')->where('status', 1)->get();
        return view('frontend.pages.home.index', compact('sliders','brands','categories','articles'));
    }
    public function productData(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->param;
            $data = VendorProduct::with('product_details','product_details.brand_details','product_details.category_details')
                ->whereHas('product_details', function($q) use($search){
                $q->where('category', '=', $search);
            })->get()->unique('product');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<div style="width: 140px">
                            <a class="view" href="javascript:void(0)" title="Quick View"  onclick="viewProduct('.$row->id.')"><i class="fas fa-eye"></i></a>
                             <a class="view" href="/product-list/'.$row->product.'" title="Similar Product" ><i class="fas fa-angle-double-right"></i></a>
                            <a class="view" href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#product-view"><i class="fas fa-cart-plus"></i></a>
                            </div>';

                    return $btn;
                })
                ->addColumn('photo', function($row){
                    return '<img href="javascript:void(0)" style="width: 50px; border-radius: 50%" src="/storage/product/'.$row->product_details->photo .'">';
                })
                ->addColumn('brand', function($row){
                    return $row->product_details->brand_details->title;
                })
                ->addColumn('vendor', function($row){
                    $t = VendorProduct::with('vendor')->where('product', $row->id)->orderBy('point', 'desc')->first();
                    return $t->vendor->name;
                })->addColumn('points', function($row){
                    $t = VendorProduct::with('vendor')->where('product', $row->id)->orderBy('point', 'desc')->first();
                    return $t->point;
                })
                ->addColumn('price', function($row){
                    $t = VendorProduct::with('vendor')->where('product', $row->id)->orderBy('point', 'desc')->first();
                    return $t->sell_price.' Tk';
                })
                ->rawColumns(['action', 'photo', 'vendor', 'brand', 'points', 'price'])
                ->make(true);
        }
        return view('frontend.pages.product-list.index');
    }

    public function product($id)
    {
        return view('frontend.pages.product-list.index');
    }
    public function brandData(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->param;
            $data = Product::with('unit_details','category_details','brand_details')->where('brand', $search)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<div style="width: 140px">
                             <a class="view" title="Quick View"  onclick="viewProduct('.$row->id.')"><i class="fas fa-eye"></i></a>
                             <a class="view" href="/product-list/'.$row->product.'" title="Similar Product" ><i class="fas fa-angle-double-right"></i></a>
                              </div>';

                    return $btn;
                })
                ->addColumn('photo', function($row){
                    return '<img style="width: 50px; border-radius: 50%" src="/storage/product/'.$row->photo .'">';
                })
                ->rawColumns(['action', 'photo'])
                ->make(true);
        }
        return view('frontend.pages.brand-list.index');
    }

    public function brand($id)
    {
        return view('frontend.pages.brand-list.index');
    }
    public function productDetails($id){
        $target = VendorProduct::with('product_details','vendor','product_details.unit_details','product_details.brand_details','product_details.category_details')->where('id', $id)->first();
        return response()->json([
            'data' => $target,
            'message' => 'fetched'
        ],200);
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
