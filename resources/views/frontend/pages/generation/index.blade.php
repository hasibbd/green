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
                                    <h6 class="media-heading small">{{$parent->name}}</h6>
                                    <span class="testimony-body">Phone: {{$parent->phone}}</span><br>
                                    <span class="small text-success">User ID: {{$parent->user_id}}</span> <br>
                                    <span class="small text-success">Last Shopping: @if($parent->last_shop){{date("F j, Y", strtotime($parent->last_shop->created_at))}} @else N/A @endif</span>
                                </div>
                            </div>
                        </div>
                    </div>
              </div>
           </div>
            <hr>
            <h6>{{$gen-1}} Generation ({{$child->count()}})</h6>
            <div class="row">
                @foreach($child as $c)
                <div class="col-md-4 testimonial py-1">
                    <a href="{{url('user-generation/'.$gen.'/'.$c->id)}}">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="avatar col-md-4 text-center
text-center ">
                                            <img style="width: 80px; height: 80px" class="img-circle" src="/storage/user/{{$c->photo}}" alt="{{$c->name}}">
                                        <br>
                                        @if($c->status == 0)
                                        <span class="text-danger">Deactivated</span>
                                        @else
                                            <span class="text-success">Active</span>
                                        @endif
                                    </div>
                                    <div class="testimonial-main col-md-8">
                                        <h6 class="media-heading small">{{$c->name}}</h6>
                                        <span class="testimony-body">Phone: {{$c->phone}}</span><br>
                                        <span class="small text-success">User ID: {{$c->user_id}}</span><br>
                                        <span class="small text-success">Last Shopping: @if($c->last_shop){{date("F j, Y", strtotime($c->last_shop->created_at))}} @else N/A @endif</span>
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
