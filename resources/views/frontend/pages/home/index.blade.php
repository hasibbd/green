@extends('frontend.app.layout')
@section('content')
<div class="backdrop"></div>
<a class="backtop fas fa-arrow-up" href="#"></a>
@include('frontend.partial.head')
@include('frontend.partial.nav')
@include('frontend.partial.cart')
@include('frontend.partial.side-nav')
@include('frontend.partial.mobile')
<section class="home-index-slider slider-arrow slider-dots">
    @foreach($sliders as $s)
        @if($loop->iteration%2)
            <div class="banner-part banner-1">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6 col-lg-6">
                            <div class="banner-content"><h1>{{$s->title}}</h1>
                                <p>{{$s->detail}}</p>
                                {{--<div class="banner-btn"><a class="btn btn-inline" href="shop-4column.html"><i
                                            class="fas fa-shopping-basket"></i><span>shop now</span></a><a
                                        class="btn btn-outline" href="offer.html"><i class="icofont-sale-discount"></i><span>get offer</span></a>
                                </div>--}}
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="banner-img"><img src="{{asset('/storage/slider/'.$s->photo)}}" alt="index"></div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="banner-part banner-2">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6 col-lg-6">
                            <div class="banner-img"><img  src="{{asset('/storage/slider/'.$s->photo)}}" alt="index"></div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="banner-content"><h1>{{$s->title}}</h1>
                                <p>{{$s->detail}}</p>
                                {{--<div class="banner-btn"><a class="btn btn-inline" href="shop-4column.html"><i
                                            class="fas fa-shopping-basket"></i><span>shop now</span></a><a
                                        class="btn btn-outline" href="offer.html"><i class="icofont-sale-discount"></i><span>get offer</span></a>
                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</section>
<section class="section suggest-part">
    <div class="container">
        <ul class="suggest-slider slider-arrow">
            @foreach($categories as $c)
            <li>
                <a class="suggest-card" href="{{url('product/'.$c->id)}}">
                    <img src="{{asset('/storage/category/'.$c->photo)}}" alt="suggest">
                    <h5>{{$c->title}} <span>
                            <?php
                            $ite = 0;
                            foreach ($c->product as $p){
                                if ($p->vendor_product){
                                    $ite += $p->vendor_product->count();
                                }
                            }
                            echo $ite;
                            ?>

                            items</span></h5>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</section>
<section class="section brand-part">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading"><h2>shop by brands</h2></div>
            </div>
        </div>
        <div class="brand-slider slider-arrow">
            @foreach($brands as $b)
            <div class="brand-wrap">
                <div class="brand-media"><img src="{{asset('/storage/brand/'.$b->photo)}}" alt="brand">
                    <div class="brand-overlay"><a href="{{url('brand-products/'.$b->id)}}"><i class="fas fa-link"></i></a></div>
                </div>
                <div class="brand-meta"><h4>{{$b->title}}</h4>
                    <p>({{$b->product->count()}} items)</p></div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="section-btn-50"><a href="brand-list.html" class="btn btn-outline"><i class="fas fa-eye"></i><span>view all brands</span></a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section testimonial-part">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading"><h2>client's feedback</h2></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="testimonial-slider slider-arrow">
                    <div class="testimonial-card"><i class="fas fa-quote-left"></i>
                        <p>Lorem ipsum dolor consectetur adipisicing elit neque earum sapiente vitae obcaecati magnam
                            doloribus magni provident ipsam</p><h5>mahmud hasan</h5>
                        <ul>
                            <li class="fas fa-star"></li>
                            <li class="fas fa-star"></li>
                            <li class="fas fa-star"></li>
                            <li class="fas fa-star"></li>
                            <li class="fas fa-star"></li>
                        </ul>
                        <img src="{{asset('frontend/images/avatar/01.jpg')}}" alt="testimonial"></div>
                    <div class="testimonial-card"><i class="fas fa-quote-left"></i>
                        <p>Lorem ipsum dolor consectetur adipisicing elit neque earum sapiente vitae obcaecati magnam
                            doloribus magni provident ipsam</p><h5>mahmud hasan</h5>
                        <ul>
                            <li class="fas fa-star"></li>
                            <li class="fas fa-star"></li>
                            <li class="fas fa-star"></li>
                            <li class="fas fa-star"></li>
                            <li class="fas fa-star"></li>
                        </ul>
                        <img src="{{asset('frontend/images/avatar/02.jpg')}}" alt="testimonial"></div>
                    <div class="testimonial-card"><i class="fas fa-quote-left"></i>
                        <p>Lorem ipsum dolor consectetur adipisicing elit neque earum sapiente vitae obcaecati magnam
                            doloribus magni provident ipsam</p><h5>mahmud hasan</h5>
                        <ul>
                            <li class="fas fa-star"></li>
                            <li class="fas fa-star"></li>
                            <li class="fas fa-star"></li>
                            <li class="fas fa-star"></li>
                            <li class="fas fa-star"></li>
                        </ul>
                        <img src="{{asset('frontend/images/avatar/03.jpg')}}" alt="testimonial"></div>
                    <div class="testimonial-card"><i class="fas fa-quote-left"></i>
                        <p>Lorem ipsum dolor consectetur adipisicing elit neque earum sapiente vitae obcaecati magnam
                            doloribus magni provident ipsam</p><h5>mahmud hasan</h5>
                        <ul>
                            <li class="fas fa-star"></li>
                            <li class="fas fa-star"></li>
                            <li class="fas fa-star"></li>
                            <li class="fas fa-star"></li>
                            <li class="fas fa-star"></li>
                        </ul>
                        <img src="{{asset('frontend/images/avatar/04.jpg')}}" alt="testimonial"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section blog-part">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading"><h2>Read our articles</h2></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-slider slider-arrow">
                    @foreach($articles as $a)
                    <div class="blog-card">
                        <div class="blog-media"><a class="blog-img" href="{{url('read/'.$a->id)}}"><img src="{{asset('/storage/article/'.$a->photo)}}"
                                                                                  alt="blog"></a></div>
                        <div class="blog-content">
                            <ul class="blog-meta">
                                <li><i class="fas fa-user"></i><span>{{$a->creator->name}}</span></li>
                                <li><i class="fas fa-calendar-alt"></i><span>{{date("F j, Y, g:i a", strtotime($a->created_at))}}</span></li>
                            </ul>
                            <h4 class="blog-title"><a href="{{url('read/'.$a->id)}}">{{$a->title}}</a></h4>
                            <p class="blog-desc">{{mb_strimwidth($a->details, 0, 200, "...")}}</p><a class="blog-btn" href="{{url('read/'.$a->id)}}"><span>read more</span><i
                                    class="icofont-arrow-right"></i></a></div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="section-btn-25"><a href="{{url('article-list')}}" class="btn btn-outline"><i
                            class="fas fa-eye"></i><span>view all blog</span></a></div>
            </div>
        </div>
    </div>
</section>
@include('frontend.partial.news')
@include('frontend.partial.intro')
@endsection
