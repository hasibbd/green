@extends('frontend.app.layout')
@section('content')
    <div class="backdrop"></div>
    <a class="backtop fas fa-arrow-up" href="#"></a>
    @include('frontend.partial.head')
    @include('frontend.partial.nav')
    @include('frontend.partial.cart')
    @include('frontend.partial.side-nav')
    @include('frontend.partial.mobile')
<section class="inner-section orderlist-par pt-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="orderlist-filter"><h5>total order <span>- ({{$orders->count()}})</span></h5>
                    <div class="filter-short">
                     {{--   <label class="form-label">short by:</label>
                        <select class="form-select">
                            <option value="all" selected="">all order</option>
                            <option value="recieved">recieved order</option>
                            <option value="processed">processed order</option>
                            <option value="shipped">shipped order</option>
                            <option value="delivered">delivered order</option>
                        </select>--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @foreach($orders->reverse() as $o)
                <div class="orderlist">
                    <div class="orderlist-head"><h5>order#{{$o->order_id}}</h5><h5>order recieved</h5></div>
                    <div class="orderlist-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="order-track">
                                    <ul class="order-track-list">
                                        <li class="order-track-item active">
                                            <i class="icofont-check"></i>
                                            <span>order processing</span>
                                        </li>
                                        <li class="order-track-item  @if(($o->details->where('status', -1)->count() + $o->details->where('status', -1)->count()) > 0 && $o->details->where('status', 3)->count() == 0)
                                        active
                                        @endif">
                                            @if(($o->details->where('status', -1)->count() + $o->details->where('status', -1)->count()) > 0 && $o->details->where('status', 3)->count() == 0)
                                                <i class="icofont-check"></i>
                                            @else
                                                <i class="icofont-close"></i>
                                            @endif

                                            <span>order shipped</span>
                                        </li>
                                        <li class="order-track-item">
                                            <i class="icofont-close"></i>
                                            <span>order delivered</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <ul class="orderlist-details">
                                    <li><h6>order id</h6>
                                        <p>{{$o->order_id}}</p></li>
                                   {{-- <li><h6>Total Item</h6>
                                        <p>{{$o->details->count()}}</p></li>--}}
                                    <li><h6>Order Time</h6>
                                        <p>{{date("F j, Y, g:i a", strtotime($o->created_at))}}</p></li>
                                   {{-- <li><h6>Delivery Time</h6>
                                        <p>12th February 2021</p></li>--}}
                                </ul>
                            </div>
                            <div class="col-lg-4">
                                <ul class="orderlist-details">
                                    <li><h6>Total Point</h6>
                                        <p>
                                            <?php
                                            $to = 0;
                                            $price = 0;
                                            foreach ($o->details as $d){
                                                $to += $d->point*$d->qty;
                                                $price += $d->price*$d->qty;
                                            }
                                            echo $to;
                                            ?>
                                        </p></li>
                                    <li><h6>Total Price</h6>
                                        <p>{{$price}}</p></li>
                                </ul>
                            </div>
                            <div class="col-lg-4">
                                <ul class="orderlist-details">
                                    <li><h6>Store</h6>
                                        <p>{{$o->vendor->name}}</p></li>
                                    <li><h6>Payment Status</h6>
                                        <p>{{$o->is_paid}}</p></li>
                                </ul>
                            </div>
                            <div class="col-lg-12"  >
                                <div>
                                        <button style="padding: 0px !important;" class="btn btn-sm btn-success" onclick="AcceptAll({{$o->id}})">Accept All Delivery</button>
                                        <button style="padding: 0px !important;" class="btn btn-sm btn-success" onclick="AcceptAllCan({{$o->id}})">Accept All Cancellation</button>
                                </div>
                                <div class="table-scroll">
                                    <table class="table-list" id="AllATble">
                                        <thead>
                                        <tr>
                                            <th scope="col">Sl.</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Total Price</th>
                                            <th scope="col">Total Point</th>
                                            <th scope="col">brand</th>
                                            <th scope="col">quantity</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($o->details as $d)
                                        <tr>
                                            <td class="table-serial"><span class="small">{{$loop->iteration}}</span></td>
                                            <td class="table-image"><img style="width: 40px; height: 40px" src="storage/product/{{$d->vendor_details->product_details->photo}}" alt="product"></td>
                                            <td class=""><span class="small">{!! nl2br($d->vendor_details->product_details->name) !!}</span></td>
                                            <td class="table-price"><span class="small">{{$d->price}}<small>/{{$d->vendor_details->product_details->unit_details->name}}</small></span></td>
                                            <td class="table-price"><span class="small">{{$d->price*$d->qty}}</span></td>
                                            <td class="table-brand"><span class="small">{{$d->point*$d->qty}}</span></td>
                                            <td class="table-brand"><span class="small">{{$d->vendor_details->product_details->brand_details->title}}</span></td>
                                            <td class="table-quantity"><span class="small">{{$d->qty}}</span></td>
                                            <td class="table-quantity">
                                                @if($d->status == 1)
                                                <button style="padding: 0px !important;" class="btn btn-sm btn-success" onclick="Accept({{$d->id}})">Accept Delivery</button>
                                                @elseif($d->status == -1)
                                                <button style="padding: 0px !important;" class="btn btn-sm btn-warning" onclick="Accept({{$d->id}})">Accept Cancellation</button>
                                                @elseif($d->status == -2)
                                                    <button style="padding: 0px !important;" class="btn btn-sm btn-danger">Canceled</button>
                                                @elseif($d->status == 2)
                                                    <button style="padding: 0px !important;" class="btn btn-sm btn-primary">Accepted</button>
                                                @else
                                                    <button style="padding: 0px !important;" class="btn btn-sm btn-primary">Pending</button>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="{{$orders->previousPageUrl()}}"><i
                                class="fas fa-long-arrow-alt-left"></i></a></li>
                    @php($s = 1)
                    @foreach($orders->getUrlRange(1, $orders->lastPage()) as $ser)
                        <li class="page-item"><a class="page-link <?php if($s == $orders->currentPage()) echo 'active'; ?>" href="{{$ser}}">{{$s++}}</a></li>
                    @endforeach
                    <li class="page-item"><a class="page-link" href="{{$orders->nextPageUrl()}}"><i
                                class="fas fa-long-arrow-alt-right"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
    @include('frontend.partial.news')
    @include('frontend.partial.intro')
@endsection
