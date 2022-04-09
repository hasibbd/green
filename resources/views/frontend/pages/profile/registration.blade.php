<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="ShoppingBook - Ecommerce Food Store HTML Template">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords"
          content="organic, food, shop, ecommerce, store, html, bootstrap, template, agriculture, vegetables, products, farm, grocery, natural, online">
    <title>ShoppingBook - Register</title>
    <link rel="icon" href="{{asset('frontend/images/favicon.png')}}">
    <link rel="stylesheet" href="{{asset('frontend/fonts/flaticon/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/fonts/icofont/icofont.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/fonts/fontawesome/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/vendor/venobox/venobox.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/vendor/slickslider/slick.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/vendor/niceselect/nice-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/vendor/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/user-auth.css')}}">
    <!--Toaster-->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>
<body>
<section class="user-form-part">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-12 col-lg-12 col-xl-10">
                <div class="user-form-logo"><a href="{{url('/')}}"><img src="{{asset('frontend/images/logo.png')}}" alt="logo"></a></div>
                <div class="user-form-card">
                    <div class="user-form-title"><h2>User Registration!</h2>
                        <p>Setup A New Account In A Minute</p></div>
                    <form class="user-form" id="user_submit">
                    <div class="user-form-group">
                        <div class="user-form-social">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter your name" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Enter your email" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="Enter your phone number" id="phone" name="phone" required>
                            </div>
                      {{--      <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter your NID no">
                            </div>--}}
                        </div>
                        <div class="user-form-divider">{{--<p>or</p>--}}</div>
                        <div class="user-form-social">
                          {{--  <div class="form-group"><input type="text" class="form-control"
                                                           placeholder="Enter your user name"></div>
                            <div class="form-group"><input type="text" class="form-control"
                                                           placeholder="Enter your referral user name"></div>--}}
                            <div class="form-group"><input type="password" class="form-control" id="password" name="password"
                                                           placeholder="Enter your password" required></div>
                            <div class="form-group"><input type="password" class="form-control" id="c_password" name="c_password"
                                                           placeholder="Enter repeat password" required></div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="1"
                                       id="type" name="type">
                                <label class="form-check-label" for="type" >Register as a Store</label></div>
                            <div class="form-group d-none" id="ref">
                                <input type="text" class="form-control" id="ref_user" name="ref_user" placeholder="Enter the referral username">
                            </div>
                            <div class="form-check mb-3"><input class="form-check-input" type="checkbox" value=""
                                                                id="check"><label class="form-check-label" for="check" required>Accept
                                    all the <a href="#">Terms & Conditions</a></label></div>
                            <div class="form-button">
                                <button type="submit">register</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="user-form-remind"><p>Already Have An Account?<a href="{{url('/')}}">login here</a></p></div>
                <div class="user-form-footer"><p>ShoppingBook | &COPY; Copyright by <a href="{{url('/')}}">ShoppingBook</a></p></div>
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('frontend/vendor/bootstrap/popper.min.js')}}"></script>
<script src="{{asset('frontend/vendor/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/vendor/countdown/countdown.min.js')}}"></script>
<script src="{{asset('frontend/vendor/niceselect/nice-select.min.js')}}"></script>
<script src="{{asset('frontend/vendor/slickslider/slick.min.js')}}"></script>
<script src="{{asset('frontend/vendor/venobox/venobox.min.js')}}"></script>
<script src="{{asset('frontend/js/nice-select.js')}}"></script>
<script src="{{asset('frontend/js/countdown.js')}}"></script>
<script src="{{asset('frontend/js/accordion.js')}}"></script>
<script src="{{asset('frontend/js/venobox.js')}}"></script>
<script src="{{asset('frontend/js/slick.js')}}"></script>
<script src="{{asset('frontend/js/main.js')}}"></script>
<!-- Sweet Alert -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!--Toaster-->
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{asset('custom/js/auth.js')}}"></script>
</body>
</html>
