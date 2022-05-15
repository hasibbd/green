<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Brand;
use App\Models\Category;
use App\Models\PointWallet;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\StoreManagerApplication;
use App\Models\UserInformation;
use App\Models\VendorProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class HomeController extends Controller
{
    public function userCreate(){
        $request = [];
        $users = [];
        $name = 'ShoppingBook';
        for ($i = 1; $i <= 100; $i++){
            $users[] = [
                'name' => $name.' ltd. '.$i,
                "user_id" => 1000000,
                'user_name' =>substr(str_replace(' ', '', strtolower($name.$i)), 0, 12),
                'photo' => 'default.png',
                'email' => strtolower($name.$i.'@email.com'),
                'phone' => '01100000',
                'role' => 0,
                'reffer_by' => null,
                'password' => Hash::make(20220515)
            ];

            $st =  UserInformation::create([
                "user_id" => 22,
                "b_date" => Carbon::createFromFormat('01/02/1984'),
                "f_name" =>  $request->f_name,
                "m_name" =>  $request->m_name,
                "gender" =>  $request->gender,
                "l_license" =>  $request->l_license,
                "l_date" =>  $request->l_date,
                "district" =>  $request->district,
                "p_station" =>  $request->p_station,
                "p_code" =>  $request->p_code,
                "occupation" =>  $request->occupation,
                "qualification" =>  $request->qualification,
                "n_name" =>  $request->n_name,
                "n_b_date" =>  $request->n_b_date,
                "relation" =>  $request->relation,
                "n_nid" =>  $request->n_nid,
                "r_name" =>  $request->r_name,
                "r_code" =>  $request->r_code,
                "a_name" =>  $request->a_name,
                "b_name" =>  $request->b_name,
                "branch" =>  $request->branch,
                "acc" =>  $request->acc,
                "created_by" => Auth::user()->id
            ]);
        }
     dd($users);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $sliders = Slider::where('status', 1)->orderBy('sort','ASC')->get();
        $brands = Brand::with('product')->orderBy('sort','ASC')->where('status', 1)->get();
        $categories = Category::with('product','product.vendor_product')->orderBy('sort','ASC')->where('status', 1)->get();
        $articles = Article::with('creator')->where('status', 1)->orderBy('sort','ASC')->get();
        return view('frontend.pages.home.index', compact('sliders','brands','categories','articles'));
    }
    public function productData(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->param;
            $data = VendorProduct::with('stock_details','product_details','product_details.brand_details','product_details.category_details')
                   ->whereHas('product_details', function($q) use($search){
                    $q->where('category', '=', $search);
                 })
                ->get()
                ->unique('product');
            $info = [];
            foreach ($data as $d){
               if ($d->stock_details->sum('qty') > 0){
                   $d->stock = $d->stock_details->sum('qty');
                     array_push($info,$d);
                }
            }
            return Datatables::of($info)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $t = VendorProduct::with('vendor')->where('product', $row->product)->orderBy('point', 'desc')->first();
                    $btn = '<div style="width: 140px">
                            <a class="view" href="javascript:void(0)" title="Quick View"  onclick="viewProduct('.$row->id.')"><i class="fas fa-eye"></i></a>
                             <a class="view" href="/product-list/'.$row->product.'" title="Similar Product" ><i class="fas fa-angle-double-right"></i></a>
                            <a class="view" href="javascript:void(0)" title="Add To Cart" onclick="AddToCart('.$t->id.')"><i class="fas fa-cart-plus"></i></a>
                            </div>';

                    return $btn;
                })
                ->addColumn('photo', function($row){
                    return '<img href="javascript:void(0)" style="width: 70px; height: 70px; border-radius: 50%" src="/storage/product/'.$row->product_details->photo .'">';
                })
                ->addColumn('brand', function($row){
                    return $row->product_details->brand_details->title;
                })
                ->addColumn('product_name', function($row){
                    return wordwrap(str_replace( array( '\'', '_', '-'), ' ', $row->product_details->name), 15, "<br />\n");
                 //   return mb_strimwidth(preg_replace('/[-_]/', ' ', $row->product_details->name), 0, 15, "...");
                })
                ->addColumn('vendor', function($row){
                    $t = VendorProduct::with('vendor')->where('product', $row->product)->orderBy('point', 'desc')->first();
                    return mb_strimwidth(preg_replace('/[-_]/', ' ', $t->vendor->name), 0, 13, "...");
                })->addColumn('points', function($row){
                    $t = VendorProduct::with('vendor')->where('product', $row->product)->orderBy('point', 'desc')->first();
                    return $t->point;
                })
                ->addColumn('price', function($row){
                    $t = VendorProduct::with('vendor')->where('product', $row->product)->orderBy('point', 'desc')->first();
                    return $t->sell_price.' Tk';
                })
                ->rawColumns(['action', 'photo', 'vendor', 'brand', 'points', 'price','product_name'])
                ->make(true);
        }
        return view('frontend.pages.product-list.index');
    }
    public function SimProductData(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->param;
            $data = VendorProduct::with('stock_details','vendor','product_details','product_details.brand_details','product_details.category_details')
                ->where('product', $search)->get();
            $info = [];
            foreach ($data as $d){
                if ($d->stock_details->sum('qty') > 0){
                    $d->stock = $d->stock_details->sum('qty');
                    array_push($info,$d);
                }
            }
            return Datatables::of($info)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<div style="width: 140px">
                            <a class="view" href="javascript:void(0)" title="Quick View"  onclick="viewProduct('.$row->id.')"><i class="fas fa-eye"></i></a>
                          <a class="view" href="javascript:void(0)" title="Add To Cart" onclick="AddToCart('.$row->id.')"><i class="fas fa-cart-plus"></i></a>
                             </div>';

                    return $btn;
                })
                ->addColumn('photo', function($row){
                    return '<img href="javascript:void(0)" style="width: 70px; height: 70px; border-radius: 50%" src="/storage/product/'.$row->product_details->photo .'">';
                })
                ->addColumn('product_name', function($row){
                    return wordwrap(str_replace( array( '\'', '_', '-'), ' ', $row->product_details->name), 15, "<br />\n");
                  //  return mb_strimwidth(preg_replace('/[-_]/', ' ', $row->product_details->name), 0, 15, "...");
                })
                ->addColumn('brand', function($row){
                    return $row->product_details->brand_details->title;
                })
                ->addColumn('vendor', function($row){
                    return mb_strimwidth(preg_replace('/[-_]/', ' ', $row->vendor->name), 0, 13, "...");
                })->addColumn('points', function($row){
                    return $row->point;
                })
                ->addColumn('price', function($row){
                    return $row->sell_price;
                })
                ->rawColumns(['action', 'photo', 'vendor', 'brand', 'points', 'price','product_name'])
                ->make(true);
        }
        return view('frontend.pages.sim-product-list.index');
    }

    public function product($id)
    {
        return view('frontend.pages.product-list.index');
    }
    public function SimProduct($id)
    {
        return view('frontend.pages.sim-product-list.index');
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
                             <a class="view" href="javascript:void(0)" title="Quick View"  onclick="viewProduct('.$row->id.')"><i class="fas fa-eye"></i></a>
                             <a class="view" href="/product-list/'.$row->id.'" title="Similar Product" ><i class="fas fa-angle-double-right"></i></a>
                              </div>';

                    return $btn;
                })
                ->addColumn('photo', function($row){
                    return '<img style="width: 70px; height: 70px; border-radius: 50%" src="/storage/product/'.$row->photo .'">';
                })
                ->addColumn('product', function($row){
                    return wordwrap(str_replace( array( '\'', '_', '-'), ' ', $row->name), 20, "<br />\n");
                    //  return mb_strimwidth(preg_replace('/[-_]/', ' ', $row->product_details->name), 0, 15, "...");
                })
                ->rawColumns(['action', 'photo','product'])
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
    public function AppApprove($point){
        $user = UserInformation::where('user_id', Auth::user()->id)->first();
        $setting = Setting::find(3);
        $app = false;
        if ($user){
            $app = false;
        } else{
            if ($point >= $setting->point_rate){
                $app = true;
            }else{
                $app = false;
            }
        }

        return $app;
    }
    public function profile(Request $request){
        $wallet = PointWallet::where('user_id', Auth::user()->id)->get();
        $is_app = $this->AppApprove($wallet->sum('point'));
        $is_store_manager = StoreManagerApplication::where('user_id', Auth::user()->id)->first();
        if ($request->ajax()) {
            $data = $wallet;
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    return 1;
                }) ->addColumn('date', function($row){
                    return date("F j, Y, g:i a", strtotime($row->created_at));
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('frontend.pages.profile.index', compact('wallet','is_app','is_store_manager'));
    }
    public function changePass(){
        return view('frontend.pages.profile.passchange');
    }
    public function read($id){
        $article = Article::where('id', $id)->first();
        $previous = Article::where('id', '<', $article->id)->orderBy('id','asc')->first();
        $next = Article::where('id', '>', $article->id)->orderBy('id','asc')->first();
        return view('frontend.pages.blog.index', compact('article','previous','next'));
    }
    public function Allread(){
        $article = Article::latest()->paginate();
        return view('frontend.pages.blog.all', compact('article'));
    }
    public function terms(){
        return view('frontend.pages.term.index');
    }
}
