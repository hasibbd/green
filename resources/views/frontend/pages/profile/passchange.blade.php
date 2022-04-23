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
    <section class="user-form-part">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                    <div class="user-form-logo"><a href="{{url('/')}}"><img src="{{asset('frontend/images/logo.png')}}" alt="logo"></a></div>
                    <div class="user-form-card">
                        <div class="user-form-title"><h2>any issue?</h2>
                            <p>Make sure your current password is strong</p></div>
                        <form class="user-form" id="pass_change" method="post">
                            @csrf
                            <div class="form-group">
                                <input name="o_pass"  id="o_pass" required type="password" class="form-control" placeholder="Old password">
                            </div>
                            <div class="form-group"><input name="n_pass" id="n_pass" type="password" class="form-control"
                                                           placeholder="Current password" required></div>
                            <div class="form-group"><input name="r_pass" id="r_pass"  type="password" class="form-control"
                                                           placeholder="reapet password" required></div>
                            <div class="form-button">
                                <button type="submit">change password</button>
                            </div>
                        </form>
                    </div>
                    <div class="user-form-remind"><p>Go Back To<a href="{{url('login')}}">login here</a></p></div>
                    <div class="user-form-footer"><p>ShoppingBook | &COPY; Copyright</p></div>
                </div>
            </div>
        </div>
    </section>
@include('frontend.partial.news')
@include('frontend.partial.intro')
@endsection
