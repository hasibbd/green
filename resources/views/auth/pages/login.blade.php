<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Green - Login</title>
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

</head>
<body>
<section class="user-form-part">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="user-form-logo"><a href="{{url('/')}}"><img
                            src="{{asset('frontend/images/logo.png')}}" alt="logo"></a></div>
                <div class="user-form-card">
                    <div class="user-form-title"><h2>welcome!</h2>
                        <p>Use your credentials to access</p></div>

                       <div class="col-8 offset-2">
                           @if($errors->any())
                               <input type="hidden" value="@if($errors->first()) 1 @else 0 @endif" id="check">
                           @endif
                           <?php
                           echo $errors->first();
                           ?>
                       </div>
                    <br>

                    <div class="user-form-group">
                        <form class="user-form" action="{{url('login-check')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="email" name="email" class="form-control"
                                       placeholder="Enter your email">
                            </div>

                            <div class="form-group">
                                <input type="password" name="password" class="form-control"
                                       placeholder="Enter your password">
                            </div>

                            {{--                            <div class="form-check mb-3">--}}
                            {{--                                <input class="form-check-input" type="checkbox" value=""--}}
                            {{--                                                                id="check">--}}
                            {{--                                <label class="form-check-label" for="check">Remember Me</label>--}}
                            {{--                            </div>--}}
                            <div class="form-button">
                                <button type="submit">login</button>
                                <p>Forgot your password?<a href="#">reset here</a></p></div>
                        </form>
                    </div>
                </div>
                <div class="user-form-remind"><p>Don't have any account?<a href="{{url('registration')}}">register
                            here</a></p>
                </div>
                <div class="user-form-footer"><p>Green | &COPY; Copyright by <a href="#">Green</a></p></div>
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

<script>
    $(document).ready(function() {
        if($('#check').val() == 1){
            $('.alert').alert()
            setTimeout(function() {
                $(".alert").alert('close');
            }, 4000);
        }else{
            $('.alert').alert('close')
        }
    });
</script>


</body>
</html>
