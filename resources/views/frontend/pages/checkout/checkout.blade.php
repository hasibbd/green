@extends('frontend.app.layout')
@section('content')
    <div class="backdrop"></div>
    <a class="backtop fas fa-arrow-up" href="#"></a>
    @include('frontend.partial.head')
    @include('frontend.partial.nav')
    @include('frontend.partial.cart')
    @include('frontend.partial.side-nav')
    @include('frontend.partial.mobile')
    <div class="modal fade" id="product-view">
        <div class="modal-dialog">
            <div class="modal-content">
                <button class="modal-close icofont-close" data-bs-dismiss="modal"></button>
                <div class="product-view">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="view-gallery">
                                <div class="view-label-group"><label class="view-label new">new</label><label
                                        class="view-label off">-10%</label></div>
                                <ul class="preview-slider slider-arrow">
                                    <li><img src="{{asset('frontend/images/product/01.jpg')}}" alt="product"></li>
                                    <li><img src="{{asset('frontend/images/product/01.jpg')}}" alt="product"></li>
                                    <li><img src="{{asset('frontend/images/product/01.jpg')}}" alt="product"></li>
                                    <li><img src="{{asset('frontend/images/product/01.jpg')}}" alt="product"></li>
                                    <li><img src="{{asset('frontend/images/product/01.jpg')}}" alt="product"></li>
                                    <li><img src="{{asset('frontend/images/product/01.jpg')}}" alt="product"></li>
                                    <li><img src="{{asset('frontend/images/product/01.jpg')}}" alt="product"></li>
                                </ul>
                                <ul class="thumb-slider">
                                    <li><img src="{{asset('frontend/images/product/01.jpg')}}" alt="product"></li>
                                    <li><img src="{{asset('frontend/images/product/01.jpg')}}" alt="product"></li>
                                    <li><img src="{{asset('frontend/images/product/01.jpg')}}" alt="product"></li>
                                    <li><img src="{{asset('frontend/images/product/01.jpg')}}" alt="product"></li>
                                    <li><img src="{{asset('frontend/images/product/01.jpg')}}" alt="product"></li>
                                    <li><img src="{{asset('frontend/images/product/01.jpg')}}" alt="product"></li>
                                    <li><img src="{{asset('frontend/images/product/01.jpg')}}" alt="product"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="view-details">
                                <h3 class="view-name"><a href="product-video.html">existing product
                                        name</a></h3>
                                <div class="view-meta">
                                    <p>SKU:<span>1234567</span></p>
                                    <p>BRAND:<a href="#">radhuni</a></p>
                                </div>
                                <div class="view-rating"><i class="active icofont-star"></i><i
                                        class="active icofont-star"></i><i class="active icofont-star"></i><i
                                        class="active icofont-star"></i><i class="icofont-star"></i><a
                                        href="product-video.html">(3 reviews)</a></div>
                                <h3 class="view-price">
                                    <del>$38.00</del>
                                    <span>$24.00<small>/per kilo</small></span>
                                </h3>
                                <p class="view-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit non tempora
                                    magni repudiandae sint suscipit tempore quis maxime explicabo veniam eos
                                    reprehenderit
                                    fuga</p>
                                <div class="view-list-group"><label class="view-list-title">tags:</label>
                                    <ul class="view-tag-list">
                                        <li><a href="#">organic</a></li>
                                        <li><a href="#">vegetable</a></li>
                                        <li><a href="#">chilis</a></li>
                                    </ul>
                                </div>
                                <div class="view-list-group"><label class="view-list-title">Share:</label>
                                    <ul class="view-share-list">
                                        <li><a href="#" class="icofont-facebook" title="Facebook"></a></li>
                                        <li><a href="#" class="icofont-twitter" title="Twitter"></a></li>
                                        <li><a href="#" class="icofont-linkedin" title="Linkedin"></a></li>
                                        <li><a href="#" class="icofont-instagram" title="Instagram"></a></li>
                                    </ul>
                                </div>
                                <div class="view-add-group">
                                    <button class="product-add" title="Add to Cart"><i
                                            class="fas fa-shopping-basket"></i><span>add to cart</span></button>
                                    <div class="product-action">
                                        <button class="action-minus" title="Quantity Minus"><i
                                                class="icofont-minus"></i>
                                        </button>
                                        <input class="action-input" title="Quantity Number" type="text" name="quantity"
                                               value="1">
                                        <button class="action-plus" title="Quantity Plus"><i class="icofont-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="view-action-group"><a class="view-wish wish" href="#"
                                                                  title="Add Your Wishlist"><i
                                            class="icofont-heart"></i><span>add to
                                        wish</span></a><a class="view-compare" href="compare.html"
                                                          title="Compare This Item"><i class="fas fa-random"></i><span>Compare This</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="inner-section checkout-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert-info">
                        <p>Returning customer? <a href="{{ url('login') }}">Click here to login</a></p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="account-card">
                        <div class="account-title">
                            <h4>Your order</h4>
                        </div>
                        <div class="account-content">
                            <div class="table-scroll">
                                <table class="table-list">
                                    <thead>
                                    <tr>
                                        <th scope="col">Serial</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Point</th>
                                        <th scope="col">quantity</th>
                                        <th scope="col">Vendor Name</th>
                                        <th scope="col">action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @php
                                        $subTotal = 0;
                                    @endphp
                                    @foreach(session('cart') as $cart)
                                        @php
                                            $subTotal += $cart['price'] * $cart['quantity'];
                                        @endphp
                                        <tr>
                                            <td class="table-serial">
                                                <h6>{{$loop->iteration}}</h6>
                                            </td>
                                            <td class="table-image">
                                                <img src="{{asset('frontend/images/product/01.jpg')}}" alt="product">
                                            </td>
                                            <td class="table-name">
                                                <h6>{{$cart['name']}}</h6>
                                            </td>
                                            <td class="table-price">
                                                <h6>TK.{{$cart['price']}}<small>/kilo</small></h6>
                                            </td>
                                            <td class="table-price">
                                                <h6>{{$cart['point']}}</h6>
                                            </td>

                                            <td class="table-quantity">
                                                <h6>{{$cart['quantity']}}</h6>
                                            </td>
                                            <td class="table-name">
                                                <h6>{{$cart['vendor']}}</h6>
                                            </td>
                                            <td class="table-action"><a class="view" href="#" title="Quick View"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#product-view"><i
                                                        class="fas fa-eye"></i></a><a class="trash" href="#"
                                                                                      title="Remove Wishlist"><i
                                                        class="icofont-trash"></i></a></td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="chekout-coupon">
                                <button class="coupon-btn">Do you have a coupon code?</button>
                                <form class="coupon-form"><input type="text" placeholder="Enter your coupon code">
                                    <button type="submit"><span>apply</span></button>
                                </form>
                            </div>
                            <div class="checkout-charge">
                                <ul>
                                    <li><span>Sub total</span><span>TK. {{number_format($subTotal,2)}}</span></li>
                                    <li><span>delivery fee</span><span>$10.00</span></li>
                                    <li><span>discount</span><span>$00.00</span></li>
                                    <li>
                                        <span>Total<small>(Incl. VAT)</small></span><span>TK. {{number_format($subTotal,2)}}</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="checkout-check"><input type="checkbox" id="checkout-check"><label
                                    for="checkout-check">By
                                    making this purchase you agree to our <a href="#">Terms and Conditions</a>.</label>
                            </div>
                            <form action="{{ route('store.order') }}" method="post">
                                @csrf
                                <div class="checkout-proced">
                                    <button type="submit" class="btn btn-inline">proced to checkout</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="address-add">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button class="modal-close" data-bs-dismiss="modal"><i class="icofont-close"></i></button>
                <form class="modal-form">
                    <div class="form-title">
                        <h3>add new address</h3>
                    </div>
                    <div class="form-group"><label class="form-label">title</label><select class="form-select">
                            <option selected="">choose title</option>
                            <option value="home">home</option>
                            <option value="office">office</option>
                            <option value="Bussiness">Bussiness</option>
                            <option value="academy">academy</option>
                            <option value="others">others</option>
                        </select></div>
                    <div class="form-group"><label class="form-label">address</label><textarea class="form-control"
                                                                                               placeholder="Enter your address"></textarea>
                    </div>
                    <button class="form-btn" type="submit">save address info</button>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="payment-add">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button class="modal-close" data-bs-dismiss="modal"><i class="icofont-close"></i></button>
                <form class="modal-form">
                    <div class="form-title">
                        <h3>add new payment</h3>
                    </div>
                    <div class="form-group"><label class="form-label">card number</label><input class="form-control"
                                                                                                type="text"
                                                                                                placeholder="Enter your card number">
                    </div>
                    <button class="form-btn" type="submit">save card info</button>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="contact-edit">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button class="modal-close" data-bs-dismiss="modal"><i class="icofont-close"></i></button>
                <form class="modal-form">
                    <div class="form-title">
                        <h3>edit contact info</h3>
                    </div>
                    <div class="form-group"><label class="form-label">title</label><select class="form-select">
                            <option value="primary" selected="">primary</option>
                            <option value="secondary">secondary</option>
                        </select></div>
                    <div class="form-group"><label class="form-label">number</label><input class="form-control"
                                                                                           type="text"
                                                                                           value="+8801838288389"></div>
                    <button class="form-btn" type="submit">save contact info</button>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="address-edit">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button class="modal-close" data-bs-dismiss="modal"><i class="icofont-close"></i></button>
                <form class="modal-form">
                    <div class="form-title">
                        <h3>edit address info</h3>
                    </div>
                    <div class="form-group"><label class="form-label">title</label><select class="form-select">
                            <option value="home" selected="">home</option>
                            <option value="office">office</option>
                            <option value="Bussiness">Bussiness</option>
                            <option value="academy">academy</option>
                            <option value="others">others</option>
                        </select></div>
                    <div class="form-group"><label class="form-label">address</label><textarea class="form-control"
                                                                                               placeholder="jalkuri, fatullah, narayanganj-1420. word no-09, road no-17/A"></textarea>
                    </div>
                    <button class="form-btn" type="submit">save address info</button>
                </form>
            </div>
        </div>
    </div>
    @include('frontend.partial.news')
    @include('frontend.partial.intro')
@endsection
