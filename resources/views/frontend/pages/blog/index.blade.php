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
<section class="inner-section blog-details-part pt-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-xl-10">
                <article class="blog-details"><a class="blog-details-thumb" href=""><img src="{{asset('/storage/article/'.$article->photo)}}"
                                                                                         alt="blog"></a>
                    <div class="blog-details-content">
                        <ul class="blog-details-meta">
                            <li><i class="icofont-ui-calendar"></i><span>{{date("F j, Y, g:i a", strtotime($article->created_at))}}</span></li>
                            <li><i class="icofont-user-alt-3"></i><span>{{$article->creator->name}}</span></li>
                          {{--  <li><i class="icofont-speech-comments"></i><span>25 comments</span></li>
                            <li><i class="icofont-share-boxed"></i><span>34 share</span></li>--}}
                        </ul>
                        <h2 class="blog-details-title">{{$article->title}}</h2>
                        <p class="blog-details-desc">{{$article->details}}</p>
                    </div>
                </article>
                <div class="blog-details-navigate">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            @if($previous)
                            <div class="blog-details-prev"><h4><a href="{{url('read/'.$previous->id)}}">{{$previous->title}}</a></h4><a class="nav-arrow" href="{{url('read/'.$previous->id)}}"><i
                                        class="icofont-arrow-left"></i>prev post</a></div>
                            @endif
                        </div>
                        <div class="col-md-6 col-lg-6">
                            @if($next)
                            <div class="blog-details-next"><h4><a href="{{url('read/'.$next->id)}}">{{$next->title}}</a></h4><a class="nav-arrow" href="{{url('read/'.$next->id)}}">next post<i
                                        class="icofont-arrow-right"></i></a></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    @include('frontend.partial.news')
    @include('frontend.partial.intro')
@endsection
