@extends('frontend.app.layout')
@section('content')
    <div class="backdrop"></div>
    <a class="backtop fas fa-arrow-up" href="#"></a>
    @include('frontend.partial.head')
    @include('frontend.partial.nav')
    @include('frontend.partial.cart')
    @include('frontend.partial.side-nav')
    @include('frontend.partial.mobile')

    <section class="inner-section invoice-part pt-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert-info">
                        <p>Thank you! We have received your order.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center mt-5"><a class="btn btn-inline" href="{{url('invoice')}}"><i
                            class="icofont-download"></i><span>download invoice</span></a>
                    <div class="back-home">
                        <a href="{{ url('/') }}">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.partial.news')
    @include('frontend.partial.intro')
@endsection
