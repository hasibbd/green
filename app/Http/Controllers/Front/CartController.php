<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\VendorProduct;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function checkOut(){
        if (auth()->user()){
              return view('frontend.pages.checkout.checkout');
        }else{
            return redirect()->route('/');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function addToCart($id)
    {
        $target = VendorProduct::with('product_details','vendor','product_details.unit_details','product_details.brand_details','product_details.category_details')->where('id', $id)->first();
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "id" => $id,
                "name" => $target->product_details->name,
                "quantity" => 1,
                "price" => $target->sell_price,
                "point" => $target->point,
                "vendor" => $target->vendor->name,
                "image" => $target->product_details->photo
            ];
        }

        session()->put('cart', $cart);

        $allCart = [];
       foreach (session('cart') as $c){
            array_push($allCart,[
                "id" => $c['id'],
                "name" => $c['name'],
                "quantity" => $c['quantity'],
                "price" => $c['price'],
                "point" => $c['point'],
                "vendor" => $c['vendor'],
                "image" => "/storage/product/".$c['image']
            ]);
        }
       return response()->json([
          'data' =>  $allCart,
           'message' => 'Product Added'
       ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function decreseCart($id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            if ($cart[$id]['quantity'] > 0){
                $cart[$id]['quantity'] --;
            }
        }
        session()->put('cart', $cart);
        $allCart = [];
        foreach (session('cart') as $c){
            array_push($allCart,[
                "id" => $c['id'],
                "name" => $c['name'],
                "quantity" => $c['quantity'],
                "price" => $c['price'],
                "point" => $c['point'],
                "vendor" => $c['vendor'],
                "image" => "/storage/product/".$c['image']
            ]);
        }
        return response()->json([
            'data' =>  $allCart,
            'message' => 'Product Added'
        ]);
    }
    public function getCart()
    {
        $allCart = [];
        if (session('cart')){
            foreach (session('cart') as $c){
                array_push($allCart,[
                    "id" => $c['id'],
                    "name" => $c['name'],
                    "quantity" => $c['quantity'],
                    "price" => $c['price'],
                    "point" => $c['point'],
                    "vendor" => $c['vendor'],
                    "image" => "/storage/product/".$c['image']
                ]);
            }
            return response()->json([
                'data' =>  $allCart,
                'message' => 'Product Added'
            ]);
        }
    }

    /**
     * Write code on Method
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function remove($id)
    {
        if($id) {
            $cart = session()->get('cart');
            if(isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
            $allCart = [];
            foreach (session('cart') as $c){
                array_push($allCart,[
                    "id" => $c['id'],
                    "name" => $c['name'],
                    "quantity" => $c['quantity'],
                    "price" => $c['price'],
                    "point" => $c['point'],
                    "vendor" => $c['vendor'],
                    "image" => "/storage/product/".$c['image']
                ]);
            }
            return response()->json([
                'data' =>  $allCart,
                'message' => 'Product Removed'
            ]);
        }
    }
}
