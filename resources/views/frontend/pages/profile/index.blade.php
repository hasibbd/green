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
    <section class="profile-part">
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
                                    <div class="profile-image"><a href="#"><img src="{{asset('frontend/images/user.png')}}" alt="user"></a></div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group"><label class="form-label">name</label><input
                                            class="form-control" type="text" value="Miron Mahmud"></div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group"><label class="form-label">Email</label><input
                                            class="form-control" type="email" value="mironcoder@gmail.com"></div>
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
                <form class="modal-form">
                    <div class="form-title"><h3>edit profile info</h3></div>
                    <div class="form-group"><label class="form-label">profile image</label><input class="form-control"
                                                                                                  type="file"></div>
                    <div class="form-group"><label class="form-label">name</label><input class="form-control" type="text"
                                                                                         value="Miron Mahmud"></div>
                    <div class="form-group"><label class="form-label">email</label><input class="form-control" type="text"
                                                                                          value="mironcoder@gmail.com">
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
                <div class="account-card"><h3 class="account-title">Add Wallet</h3>
                    <form class="wallet-form"><input type="text" placeholder="$00.00">
                        <div class="wallet-suggest"><h6>suggested:</h6>
                            <ul>
                                <li><a href="#">$50</a></li>
                                <li><a href="#">$100</a></li>
                                <li><a href="#">$300</a></li>
                                <li><a href="#">$500</a></li>
                                <li><a href="#">$800</a></li>
                                <li><a href="#">$1000</a></li>
                                <li><a href="#">$3000</a></li>
                                <li><a href="#">$5000</a></li>
                            </ul>
                        </div>
                        <button type="submit">add to wallet</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="account-card"><h3 class="account-title">Wallet Transaction</h3>
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
