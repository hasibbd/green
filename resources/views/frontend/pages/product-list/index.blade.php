@extends('frontend.app.layout')
@section('content')

<body>
<div class="backdrop"></div>
<a class="backtop fas fa-arrow-up" href="#"></a>
@include('frontend.partial.head')
@include('frontend.partial.nav')
@include('frontend.partial.cart')
@include('frontend.partial.side-nav')
@include('frontend.partial.mobile')
@include('frontend.partial.product-view-modal')
<section class="inner-section compare-part pt-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-scroll">
                    <table class="table-list" id="product_list">
                        <thead>
                        <tr>
                            <th style="width: 7%" scope="col">Serial</th>
                            <th style="width: 10%" scope="col">Product</th>
                            <th style="width: 17%" scope="col">Name</th>
                            <th style="width: 13%" scope="col">Category</th>
                            <th style="width: 10%" scope="col">Brand</th>
                            <th style="width: 8%" scope="col">Price</th>
                            <th style="width: 8%" scope="col">Point</th>
                            <th style="width: 10%" scope="col">vendor</th>
                            <th style="width: 10%" scope="col">action</th>
                        </tr>
                        </thead>
                        <tbody>
            {{--            <tr>
                            <td class="table-serial"><h6>01</h6></td>
                            <td class="table-image"><img src="{{asset('frontend/images/product/01.jpg')}}" alt="product"></td>
                            <td class="table-name"><h6>product name</h6></td>
                            <td class="table-price"><h6>$19<small>/kilo</small></h6></td>
                            <td class="table-vendor"><a href="#">fresh greeny</a></td>
                            <td class="table-status"><h6 class="stock-out">stock out</h6></td>
                            <td class="table-shop">
                                <button class="product-add" title="Add to Cart">add to cart</button>
                                <div class="product-action">
                                    <button class="action-minus" title="Quantity Minus"><i class="icofont-minus"></i>
                                    </button>
                                    <input class="action-input" title="Quantity Number" type="text" name="quantity"
                                           value="1">
                                    <button class="action-plus" title="Quantity Plus"><i class="icofont-plus"></i>
                                    </button>
                                </div>
                            </td>
                            <td class="table-action"><a class="view" href="#" title="Quick View" data-bs-toggle="modal"
                                                        data-bs-target="#product-view"><i class="fas fa-eye"></i></a><a
                                    class="wish" href="#" title="Add to Wishlist"><i class="icofont-heart"></i></a></td>
                        </tr>--}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
{{--        <div class="row">--}}
{{--            <div class="col-lg-12">--}}
{{--                <div class="text-center mt-5">--}}
{{--                    <button class="btn btn-outline">Load more items</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</section>
@include('frontend.partial.news')
@include('frontend.partial.intro')
@endsection
