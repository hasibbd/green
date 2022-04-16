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
                @foreach($orders as $o)
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
                                        <p>{{$o->created_at}}</p></li>
                                   {{-- <li><h6>Delivery Time</h6>
                                        <p>12th February 2021</p></li>--}}
                                </ul>
                            </div>
                            <div class="col-lg-4">
                                <ul class="orderlist-details">
                                    <li><h6>Total Point</h6>
                                        <p>{{$o->details->sum('point')}}</p></li>
                                    <li><h6>Total Price</h6>
                                        <p>{{$o->details->sum('price')}}</p></li>
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
                                <div class="table-scroll">
                                    <table class="table-list" id="AllATble">
                                        <thead>
                                        <tr>
                                            <th scope="col">Serial</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">point</th>
                                            <th scope="col">brand</th>
                                            <th scope="col">quantity</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($o->details as $d)
                                        <tr>
                                            <td class="table-serial"><h6>1</h6></td>
                                            <td class="table-image"><img src="storage/product/{{$d->vendor_details->product_details->photo}}" alt="product"></td>
                                            <td class="table-name"><h6>{{$d->vendor_details->product_details->name}}</h6></td>
                                            <td class="table-price"><h6>{{$d->price}}<small>/{{$d->vendor_details->product_details->unit_details->name}}</small></h6></td>
                                            <td class="table-brand"><h6>{{$d->point}}</h6></td>
                                            <td class="table-brand"><h6>{{$d->vendor_details->product_details->brand_details->title}}</h6></td>
                                            <td class="table-quantity"><h6>{{$d->qty}}</h6></td>
                                            <td class="table-quantity">
                                                @if($d->status == 1)
                                                <button class="btn btn-sm btn-success" onclick="Accept({{$d->id}})">Accept Delivery</button>
                                                @elseif($d->status == -1)
                                                <button class="btn btn-sm btn-warning" onclick="Accept({{$d->id}})">Appect Cancelation</button>
                                                @elseif($d->status == -2)
                                                    <button class="btn btn-sm btn-danger">Canceled</button>
                                                @elseif($d->status == 2)
                                                    <button class="btn btn-sm btn-primary">Acceted</button>
                                                @else
                                                    <button class="btn btn-sm btn-primary">Pending</button>
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
