@extends('frontend.app.layout')
@section('content')
<div class="backdrop"></div>
<a class="backtop fas fa-arrow-up" href="#"></a>
@include('frontend.partial.head')
@include('frontend.partial.nav')
@include('frontend.partial.cart')
@include('frontend.partial.side-nav')
@include('frontend.partial.mobile')

<section class="inner-section single-banner"
    style="background: url(/frontend/images/single-banner.jpg) no-repeat center;">
    <div class="container">
        <h2>Order invoice</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item"><a href="shop-4column.html">shop grid</a></li>
            <li class="breadcrumb-item"><a href="product-video.html">product details</a></li>
            <li class="breadcrumb-item"><a href="checkout.html">checkout</a></li>
            <li class="breadcrumb-item active" aria-current="page">invoice</li>
        </ol>
    </div>
</section>

<section class="inner-section invoice-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="alert-info">
                    <p>Thank you! We have recieved your order.</p>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="account-card">
                    <div class="account-title">
                        <h4>order recieved</h4>
                    </div>
                    <div class="account-content">
                        <div class="invoice-recieved">
                            <h6>order number <span>1665</span></h6>
                            <h6>order date <span>february 02, 2021</span></h6>
                            <h6>total amount <span>$24,176.00</span></h6>
                            <h6>payment method <span>Cash on delivery</span></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
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
            </div>
            <div class="col-lg-12">
                <div class="table-scroll">
                    <table class="table-list">
                        <thead>
                            <tr>
                                <th scope="col">Serial</th>
                                <th scope="col">Product</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Point</th>
                                <th scope="col">brand</th>
                                <th scope="col">quantity</th>
                                <th scope="col">Vendor Name</th>
                                <th scope="col">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="table-serial">
                                    <h6>01</h6>
                                </td>
                                <td class="table-image"><img src="{{asset('frontend/images/product/01.jpg')}}"
                                        alt="product"></td>
                                <td class="table-name">
                                    <h6>product name</h6>
                                </td>
                                <td class="table-price">
                                    <h6>$19<small>/kilo</small></h6>
                                </td>
                                <td class="table-price">
                                    <h6>$19<small>/kilo</small></h6>
                                </td>
                                <td class="table-brand">
                                    <h6>Fresh Company</h6>
                                </td>
                                <td class="table-quantity">
                                    <h6>3</h6>
                                </td>
                                <td class="table-name">
                                    <h6>vendor name</h6>
                                </td>
                                <td class="table-action"><a class="view" href="#" title="Quick View"
                                        data-bs-toggle="modal" data-bs-target="#product-view"><i
                                            class="fas fa-eye"></i></a><a class="trash" href="#"
                                        title="Remove Wishlist"><i class="icofont-trash"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
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