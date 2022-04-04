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
    <section class="inner-section blog-grid pt-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="top-filter">
                               {{-- <div class="filter-show">
                                    <label class="filter-label">Show :</label>
                                    <select
                                        class="form-select filter-select">
                                        <option value="1">12</option>
                                        <option value="2">24</option>
                                        <option value="3">36</option>
                                    </select>
                                </div>--}}
                           {{--     <div class="filter-short"><label class="filter-label">Short by :</label><select
                                        class="form-select filter-select">
                                        <option selected="">default</option>
                                        <option value="3">recent</option>
                                        <option value="1">featured</option>
                                        <option value="2">recommend</option>
                                    </select></div>--}}
                             {{--   <div class="filter-action"><a href="blog-grid.html" class="active" title="Two Column"><i
                                            class="fas fa-th-large"></i></a><a href="blog-standard.html"
                                                                               title="One Column"><i
                                            class="fas fa-th-list"></i></a></div>--}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($article as $a)
                        <div class="col-md-6 col-lg-6">
                            <div class="blog-card">
                                <div class="blog-media"><a class="blog-img" href="#"><img src="{{asset('/storage/article/'.$a->photo)}}"
                                                                                          alt="blog"></a></div>
                                <div class="blog-content">
                                    <ul class="blog-meta">
                                        <li><i class="fas fa-user"></i><span>{{$a->creator->name}}</span></li>
                                        <li><i class="fas fa-calendar-alt"></i><span>{{$a->created_at}}</span></li>
                                    </ul>
                                    <h4 class="blog-title"><a href="{{url('read/'.$a->id)}}">{{$a->title}}</a></h4>
                                    <p class="blog-desc">{{mb_strimwidth($a->details, 0, 200, "...")}}</p><a class="blog-btn"
                                                                                                   href="{{url('read/'.$a->id)}}"><span>read more</span><i
                                            class="icofont-arrow-right"></i></a></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="row">
                       <div class="col-lg-12">
                            <div class="bottom-paginate">{{--<p class="page-info">Showing 12 of 60 Results</p>--}}
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="{{$article->previousPageUrl()}}"><i
                                                class="fas fa-long-arrow-alt-left"></i></a></li>
                                    @php($s = 1)
                                    @foreach($article->getUrlRange(1, $article->lastPage()) as $ser)
                                    <li class="page-item"><a class="page-link <?php if($s == $article->currentPage()) echo 'active'; ?>" href="{{$ser}}">{{$s++}}</a></li>
                                    @endforeach
                                    <li class="page-item"><a class="page-link" href="{{$article->nextPageUrl()}}"><i
                                                class="fas fa-long-arrow-alt-right"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-lg-4">
                    <div class="blog-widget"><h3 class="blog-widget-title">popular feeds</h3>
                        <ul class="blog-widget-feed">
                            @foreach($article->take(5) as $a)
                            <li>
                                <a class="blog-widget-media" href="{{url('read/'.$a->id)}}">
                                    <img src="{{asset('/storage/article/'.$a->photo)}}" alt="blog-widget">
                                </a><h6 class="blog-widget-text">
                                    <a href="{{url('read/'.$a->id)}}">{{$a->title}}</a>
                                    <span>{{$a->created_at}}</span>
                                </h6>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('frontend.partial.news')
    @include('frontend.partial.intro')
@endsection
