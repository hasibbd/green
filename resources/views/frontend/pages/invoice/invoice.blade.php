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
                <div class="col-lg-12">
                    <div class="account-card">
                        <div class="account-title">
                            <h4>order received</h4>
                        </div>
                        <div class="account-content">
                            <div class="invoice-recieved">
                                <h6>order number <span> {{$orders->order_id}}</span></h6>
                                <h6>order date <span>{{$orders->created_at}}</span></h6>
                                <h6>total amount <span> {{$orders->total_price * $orders->total_qty}}</span></h6>
                                <h6>Total Point <span>{{$orders->total_point * $orders->total_qty}}</span></h6>
                                <h6>Total Items <span>{{$orders->details->count()}}</span></h6>
                            </div>
                        </div>
                    </div>
                </div>
            {{--    <div class="col-lg-6">
                    <div class="account-card">
                        <div class="account-title">
                            <h4>Order Details</h4>
                        </div>
                        <div class="account-content">
                            <ul class="invoice-details">
                                <li>
                                    <h6>Total Item</h6>
                                    <p>6 Items</p>
                                </li>
                                <li>
                                    <h6>Order Time</h6>
                                    <p>1.00pm 10-12-2021</p>
                                </li>
                                <li>
                                    <h6>Delivery Time</h6>
                                    <p>90 Minute Express Delivery</p>
                                </li>
                                <li>
                                    <h6>Delivery Location</h6>
                                    <p>House 17/A, West Jalkuri, Dhaka.</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="account-card">
                        <div class="account-title">
                            <h4>Amount Details</h4>
                        </div>
                        <div class="account-content">
                            <ul class="invoice-details">
                                <li>
                                    <h6>Sub Total</h6>
                                    <p>$10,864.00</p>
                                </li>
                                <li>
                                    <h6>discount</h6>
                                    <p>$20.00</p>
                                </li>
                                <li>
                                    <h6>Payment Method</h6>
                                    <p>Cash On Delivery</p>
                                </li>
                                <li>
                                    <h6>Total<small>(Incl. VAT)</small></h6>
                                    <p>$10,874.00</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>--}}
            </div>
            <div class="row">
                <div class="col-lg-12 text-center mt-5"><a class="btn btn-inline" href="#"><i
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
