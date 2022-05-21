@extends('frontend.app.layout')
@section('content')
    <div class="backdrop"></div>
    <a class="backtop fas fa-arrow-up" href="#"></a>
    @include('frontend.partial.head')
    @include('frontend.partial.nav')
    @include('frontend.partial.cart')
    @include('frontend.partial.side-nav')
    @include('frontend.partial.mobile')

    <section class="inner-section invoice-part pt-3">
        <div class="container ">
            <a href="{{url('user-generation/1/1')}}"  class="btn btn-sm btn-primary">Root</a>
            <div class="row">
                <div class="col-md-4 offset-md-4 testimonial">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="avatar col-md-5">
                                        <img style="width: 80px; height: 80px" class="img-circle" src="/storage/user/{{$parent->photo}}" alt="{{$parent->name}}">
                                </div>
                                <div class="testimonial-main col-md-7">
                                    <h4 class="media-heading">{{$parent->name}}</h4>
                                    <p class="testimony-body">{{$parent->phone}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
              </div>
           </div>
            <hr>
            <h6>{{$gen-1}} Generation</h6>
            <div class="row">
                @foreach($child as $c)
                <div class="col-md-4 testimonial py-1">
                    <a href="{{url('user-generation/'.$gen.'/'.$c->id)}}">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="avatar col-md-5">
                                            <img style="width: 80px; height: 80px" class="img-circle" src="/storage/user/{{$c->photo}}" alt="{{$c->name}}">
                                    </div>
                                    <div class="testimonial-main col-md-7">
                                        <h4 class="media-heading">{{$c->name}}</h4>
                                        <p class="testimony-body">{{$c->phone}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('frontend.partial.news')
    @include('frontend.partial.intro')
@endsection
