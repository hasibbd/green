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
<section class="inner-section wallet-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="account-card"><h3 class="account-title">My Wallet</h3>
                    <div class="my-wallet"><p>current balance</p>
                        <h3>$575.00</h3></div>
                    <div class="wallet-card-group">
                        <div class="wallet-card"><p>total credit</p>
                            <h3>$2347.76</h3></div>
                        <div class="wallet-card"><p>total debit</p>
                            <h3>$2174.89</h3></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="account-card"><h3 class="account-title">Options</h3>
                    <button style="margin-bottom: 5px" class="form-btn" type="submit">Apply for registered user</button>
                    <button style="margin-bottom: 5px" class="form-btn " type="submit">Apply for store manager</button>
                    <button style="margin-bottom: 5px" class="form-btn" type="submit">Go To Dashboard</button>
                    <button class="form-btn" type="submit">Apply for store manager</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="account-card"><h3 class="account-title">Order List</h3>
                    <div class="top-filter">
                        <div class="filter-show"><label class="filter-label">Show :</label><select
                                class="form-select filter-select">
                                <option value="1">12</option>
                                <option value="2">24</option>
                                <option value="3">36</option>
                            </select></div>
                        <div class="filter-short"><label class="filter-label">Short by :</label><select
                                class="form-select filter-select">
                                <option selected="">default</option>
                                <option value="1">paid</option>
                                <option value="2">due</option>
                                <option value="3">cancel</option>
                                <option value="4">return</option>
                            </select></div>
                    </div>
                    <div class="table-scroll">
                        <table class="table mb-0">
                            <thead>
                            <tr>
                                <th scope="col">SL.</th>
                                <th scope="col">transaction date</th>
                                <th scope="col">payment method</th>
                                <th scope="col">document type</th>
                                <th scope="col">recieved amount</th>
                                <th scope="col">order amount</th>
                                <th scope="col">status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>02 February 2021</td>
                                <td>Order Altered</td>
                                <td>Order <a href="#">(26881)</a></td>
                                <td>$345.89</td>
                                <td>$345.89</td>
                                <td class="fw-bold text-success">paid</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>02 march 2021</td>
                                <td>Order Altered</td>
                                <td>Order <a href="#">(26881)</a></td>
                                <td>$345.89</td>
                                <td>$345.89</td>
                                <td class="fw-bold text-warning">due</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>02 april 2021</td>
                                <td>Order Altered</td>
                                <td>Order <a href="#">(26881)</a></td>
                                <td>$345.89</td>
                                <td>$345.89</td>
                                <td class="fw-bold text-danger">cancel</td>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <td>02 may 2021</td>
                                <td>Order Altered</td>
                                <td>Order <a href="#">(26881)</a></td>
                                <td>$345.89</td>
                                <td>$345.89</td>
                                <td class="fw-bold text-dark">return</td>
                            </tr>
                            <tr>
                                <th scope="row">5</th>
                                <td>02 june 2021</td>
                                <td>Order Altered</td>
                                <td>Order <a href="#">(26881)</a></td>
                                <td>$345.89</td>
                                <td>$345.89</td>
                                <td class="fw-bold text-info">process</td>
                            </tr>
                            <tr>
                                <th scope="row">6</th>
                                <td>02 February 2021</td>
                                <td>Order Altered</td>
                                <td>Order <a href="#">(26881)</a></td>
                                <td>$345.89</td>
                                <td>$345.89</td>
                                <td class="fw-bold text-success">paid</td>
                            </tr>
                            <tr>
                                <th scope="row">7</th>
                                <td>02 march 2021</td>
                                <td>Order Altered</td>
                                <td>Order <a href="#">(26881)</a></td>
                                <td>$345.89</td>
                                <td>$345.89</td>
                                <td class="fw-bold text-warning">due</td>
                            </tr>
                            <tr>
                                <th scope="row">8</th>
                                <td>02 april 2021</td>
                                <td>Order Altered</td>
                                <td>Order <a href="#">(26881)</a></td>
                                <td>$345.89</td>
                                <td>$345.89</td>
                                <td class="fw-bold text-danger">cancel</td>
                            </tr>
                            <tr>
                                <th scope="row">9</th>
                                <td>02 may 2021</td>
                                <td>Order Altered</td>
                                <td>Order <a href="#">(26881)</a></td>
                                <td>$345.89</td>
                                <td>$345.89</td>
                                <td class="fw-bold text-dark">return</td>
                            </tr>
                            <tr>
                                <th scope="row">10</th>
                                <td>02 june 2021</td>
                                <td>Order Altered</td>
                                <td>Order <a href="#">(26881)</a></td>
                                <td>$345.89</td>
                                <td>$345.89</td>
                                <td class="fw-bold text-info">process</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="bottom-paginate"><p class="page-info">Showing 12 of 60 Results</p>
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#"><i
                                        class="fas fa-long-arrow-alt-left"></i></a></li>
                            <li class="page-item"><a class="page-link active" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">...</li>
                            <li class="page-item"><a class="page-link" href="#">60</a></li>
                            <li class="page-item"><a class="page-link" href="#"><i
                                        class="fas fa-long-arrow-alt-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('frontend.partial.news')
@include('frontend.partial.intro')
@endsection
