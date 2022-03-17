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
                    <table class="table-list" id="sim_product_list">
                        <thead>
                        <tr>
                            <th scope="col">Serial</th>
                            <th scope="col">Product</th>
                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Price</th>
                            <th scope="col">Point</th>
                            <th scope="col">vendor</th>
                            <th scope="col">action</th>
                        </tr>
                        </thead>
                        <tbody>

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
