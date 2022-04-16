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
    <section class="profile-part pt-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="account-card">
                        <div class="account-title"><h4>Your Profile</h4>
                            <button data-bs-toggle="modal" data-bs-target="#profile-edit">edit profile</button>
                        </div>
                        <div class="account-content">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="profile-image"><a href="#"><img src="storage/user/{{Auth::user()->photo}}" alt="user"></a></div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                  <h6>Name: {{Auth::user()->name}}</h6>
                                    <h6>Email: {{Auth::user()->email}}</h6>
                                    <h6>Phone: {{Auth::user()->phone}}</h6>
                                    @if(Auth::user()->user_id)
                                    <h6>User ID: {{Auth::user()->user_id}}</h6>
                                    @endif
                                </div>
                                <div class="col-md-6 col-lg-4">

                                </div>
                                <div class="col-lg-2">
                                    <div class="profile-btn"><a href="{{url('change-password')}}">change pass.</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="profile-edit">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button class="modal-close" data-bs-dismiss="modal"><i class="icofont-close"></i></button>
                <form class="modal-form" id="basic_submit">
                    <div class="form-title"><h3>edit profile info</h3></div>
                    <div class="form-group">
                        <label class="form-label">profile image</label>
                        <input name="photo" id="photo" class="form-control" type="file">
                    </div>
                    <div class="form-group">
                        <label class="form-label">name</label>
                        <input class="form-control" type="text" name="name" value="{{Auth()->user()->name}}">
                    </div>
                    <button class="form-btn" type="submit">save profile info</button>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="apply_for_store_manager">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button class="modal-close" data-bs-dismiss="modal"><i class="icofont-close"></i></button>
                <form class="modal-form" id="store_app_submit">
                    <div class="form-title"><h3>Application For Store Manager</h3></div>
                    <div class="form-group">
                        <label class="form-label">Type 'Yes' for submit application</label>
                        <input class="form-control" type="text" name="check_yes" required>
                    </div>
                    <button class="form-btn" type="submit">Submit Application</button>
                </form>
            </div>
        </div>
    </div>
<section class="inner-section wallet-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="account-card"><h3 class="account-title">My Wallet</h3>
                    <div class="my-wallet"><p>current Point</p>
                        <h3>{{$wallet->where('point','>', 0)->sum('point')}}</h3></div>
                    <div class="wallet-card-group">
                        <div class="wallet-card"><p>total Point</p>
                            <h3>{{$wallet->sum('point')}}</h3></div>
                        <div class="wallet-card"><p>total Withdraw</p>
                            <h3>{{$wallet->where('point','<', 0)->sum('point')}}</h3></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="account-card"><h3 class="account-title">Options</h3>
                    @if($is_app)
                    <a href="{{url('user-application')}}" style="margin-bottom: 5px; color: white !important;" class="form-btn" type="submit">Apply for registered user</a>
                    @endif
                    @if(Auth::user()->is_registered && !Auth::user()->is_store_manager)
                        @if(!$is_store_manager)
                        <button data-bs-toggle="modal" data-bs-target="#apply_for_store_manager" style="margin-bottom: 5px" class="form-btn " type="button">Apply for store manager</button>
                        @endif
                    @endif
                        <a href="{{url('user-dashboard')}}" style="margin-bottom: 5px; color: white !important;" class="form-btn" type="submit">Go To Dashboard</a>
                    <a href="{{url('order-show')}}" style="margin-bottom: 5px; color: white !important;" class="form-btn" type="submit">Order Details</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-scroll">
                    <table class="table-list" id="point_list">
                        <thead>
                        <tr>
                            <th scope="col">Serial</th>
                            <th scope="col">Transaction Date</th>
                            <th scope="col">Method</th>
                            <th scope="col">Point Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@include('frontend.partial.news')
@include('frontend.partial.intro')
@endsection
