
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="ShoppingBook">
    <meta name="keywords"
          content="organic, food, shop, ecommerce, store, html, bootstrap, template, agriculture, vegetables, products, farm, grocery, natural, online">
    <title>ShoppingBook - Reset Password</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                <div class="user-form-logo"><a href="{{url('/')}}"><img
                            src="{{asset('frontend/images/logo.png')}}" alt="logo"></a></div>
                <div class="user-form-card">
                    <div class="user-form-title"><h2>any issue?</h2>
                        <p>Make sure your current password is strong</p></div>
                    <form class="user-form"  id="reset_pass">
                        <input type="hidden" name="id" value="{{$target->id}}">
                        <div class="form-group"><input name="password" id="password"  type="password" class="form-control"
                                                       placeholder="Current password"></div>
                        <div class="form-group"><input name="c_password" id="c_password" type="password" class="form-control"
                                                       placeholder="reapet password"></div>
                        <div class="form-button">
                            <button type="submit" class="btn-block load">change password</button>
                        </div>
                    </form>
                </div>
                <div class="user-form-remind"><p>Go Back To<a href="{{url('login')}}">login here</a></p></div>
                <div class="user-form-footer"><p>ShoppingBook | &COPY; Copyright by <a href="#">ShoppingBook</a></p></div>
            </div>
        </div>
    </div>
</section>
<script src="{{asset('frontend/vendor/bootstrap/jquery-1.12.4.min.js')}}"></script>
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!--Toaster-->
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{asset('custom/js/auth.js')}}"></script>
</body>
</html>
