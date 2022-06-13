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

                    <form class="user-form" id="user_reg_submit">
                        <div class="user-form-title">
                            <h2>Applicant's Information</h2>
                            {{--<p>Setup A New Account In A Minute</p>--}}
                        </div>
                        <div class="user-form-group">
                        <div class="user-form-social">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" value="{{Auth::user()->name}}" class="form-control" placeholder="Enter your name" id="name" name="name" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" value="{{Auth::user()->email}}" class="form-control" placeholder="Enter your email" id="email" name="email" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Phone</label>
                                <input type="number" value="{{Auth::user()->phone}}" class="form-control" placeholder="Enter your phone number" id="phone" name="phone" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Date of Birth</label>
                                <input type="date"  class="form-control" placeholder="Enter your birth date" id="b_date" name="b_date" required>
                            </div>
                            <div class="form-group">
                                <label for="">NID</label>
                                <input type="text" value="{{Auth::user()->nid}}" class="form-control" placeholder="Enter your nid" id="nid" name="nid" required @if(Auth::user()->nid) readonly @endif>
                            </div>
                            <div class="form-group">
                                <label for="">Father's Name</label>
                                <input type="text" class="form-control" placeholder="Enter your father's name" id="f_name" name="f_name" required>
                            </div>
                            <div class="form-group">
                                <label for="">Mother's Name</label>
                                <input type="text" class="form-control" placeholder="Enter your mother's name" id="m_name" name="m_name" required>
                            </div>
                            <div class="form-group">
                                <label for="">Gender</label>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" checked id="customRadioInline1" value="1" name="gender" class="custom-control-input">
                                    <label class="custom-control-label" for="gender1">Male</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="gender2" name="gender" value="2" class="custom-control-input">
                                    <label class="custom-control-label" for="gender2">Female</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="gender3" name="gender" value="3" class="custom-control-input">
                                    <label class="custom-control-label" for="gender3">Other</label>
                                </div>
                            </div>
                        </div>
                        <div class="user-form-divider">{{--<p>or</p>--}}</div>
                        <div class="user-form-social">
                            <div class="form-group">
                                <label for="">Trade License No.</label>
                                <input type="number" class="form-control" placeholder="Enter your phone number" id="l_license" name="l_license">
                            </div>
                            <div class="form-group">
                                <label for="">Date of Trade License</label>
                                <input type="date"  class="form-control" placeholder="Enter your birth date" id="l_date" name="l_date">
                            </div>
                            <div class="form-group">
                                <label for="">City/District</label>
                                <input type="text" class="form-control" placeholder="Enter city/district name" id="district" name="district" required>
                            </div>
                            <div class="form-group">
                                <label for="">Police Station</label>
                                <input type="text" class="form-control" placeholder="Enter police station name" id="p_station" name="p_station" required>
                            </div>
                            <div class="form-group">
                                <label for="">Postal Code</label>
                                <input type="number" class="form-control" placeholder="Postal Code" id="p_code" name="p_code" required>
                            </div>
                            <div class="form-group">
                                <label for="">Occupation</label>
                                <input type="text" class="form-control" placeholder="Enter your occupation" id="occupation" name="occupation" required>
                            </div>
                            <div class="form-group">
                                <label for="">Academic Qualification</label>
                                <input type="text" class="form-control" placeholder="Enter your qualification" id="qualification" name="qualification" required>
                            </div>
                        </div>
                    </div>
                         <div class="user-form-title">
                            <h2>Nominee's Information</h2>
                            {{--<p>Setup A New Account In A Minute</p>--}}
                        </div>
                        <div class="user-form-group">
                            <div class="user-form-social">
                                <div class="form-group">
                                    <label for="">Nominee's Name</label>
                                    <input type="text"  class="form-control" placeholder="Enter nominee's name" id="n_name" name="n_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Date of Birth</label>
                                    <input type="date"  class="form-control" placeholder="Enter nominee's birth date" id="n_b_date" name="n_b_date" required>
                                </div>
                            </div>
                            <div class="user-form-divider">{{--<p>or</p>--}}</div>
                            <div class="user-form-social">
                                <div class="form-group">
                                    <label for="">Relation</label>
                                    <input type="text" class="form-control" placeholder="Enter Relationship" id="relation" name="relation" required>
                                </div>
                                <div class="form-group">
                                    <label for="">NID/Birthday Certificate No.</label>
                                    <input type="number" class="form-control" placeholder="Enter nominee's NID/birthday certificate no. number" id="n_nid" name="n_nid" required>
                                </div>
                            </div>
                        </div>
                         <div class="user-form-title">
                            <h2>Reference Information</h2>
                            {{--<p>Setup A New Account In A Minute</p>--}}
                        </div>
                        <div class="user-form-group">
                            <div class="user-form-social">
                                <div class="form-group">
                                    <label for="">Reference (HPA) ID</label>
                                    <input type="text" class="form-control" placeholder="Enter Reference (HPA) ID" onkeyup="CheckUser()" value="{{$reffer_id}}" id="r_code" name="r_code" required @if($reffer_id) readonly @endif>
                                </div>
                                <div class="form-group">
                                    <label for="">Reference (Generation) ID</label>
                                    <input type="text" class="form-control" placeholder="Enter Reference (Generation) ID" onkeyup="CheckUser2()" value="{{$reffer_id}}" id="g_code" name="g_code" required >
                                </div>
                            </div>
                            <div class="user-form-divider">{{--<p>or</p>--}}</div>
                            <div class="user-form-social">
                              <div class="form-group">
                                    <label for="">Full Name (HPA)</label>
                                    <input type="text"  class="form-control" placeholder="Full name" id="r_name" name="r_name" value="{{$reffer_name}}" required disabled>
                                </div>
                                <div class="form-group">
                                    <label for="">Full Name (Generation)</label>
                                    <input type="text"  class="form-control" placeholder="Full name" id="g_name" name="g_name" value="{{$reffer_name}}" required disabled>
                                </div>
                            </div>
                        </div>
                        <div class="user-form-title">
                            <h2>Bank Information</h2>
                            {{--<p>Setup A New Account In A Minute</p>--}}
                        </div>
                        <div class="user-form-group">
                            <div class="user-form-social">
                                <div class="form-group">
                                    <label for="">A/C Name</label>
                                    <input type="text"  class="form-control" placeholder="Enter A/C Name" id="a_name" name="a_name" >
                                </div>
                                <div class="form-group">
                                    <label for="">Bank Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Bank Name" id="b_name" name="b_name">
                                </div>
                            </div>
                            <div class="user-form-divider">{{--<p>or</p>--}}</div>
                            <div class="user-form-social">
                                <div class="form-group">
                                    <label for="">Branch</label>
                                    <input type="text" class="form-control" placeholder="Enter Branch Name" id="branch" name="branch" >
                                </div>
                                <div class="form-group">
                                    <label for="">A/C No.</label>
                                    <input type="number" class="form-control" placeholder="Enter A/C no." id="acc" name="acc">
                                </div>
                            </div>
                        </div>
                        <div class="form-check mb-3"><input class="form-check-input" type="checkbox" value=""
                                                            id="check"><label class="form-check-label" for="check" required>Accept
                                all the <a href="#">Terms & Conditions</a></label></div>
                        <div class="form-button">
                            <button type="submit">register</button>
                        </div>
                    </form>
                </div>
                <div class="user-form-remind"><p>Back to profile?<a href="{{url('my-profile')}}">My Profile</a></p></div>
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
<script src="{{asset('custom/front/js/my-profile.js')}}"></script>
</body>
</html>
