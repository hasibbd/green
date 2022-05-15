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
               this will be terms and conditions page
            </div>
        </div>
    </div>
</section>
@include('frontend.partial.news')
@include('frontend.partial.intro')
@endsection
