@extends('admin.app.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Order List</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{'dashboard'}}">Home</a></li>
                            <li class="breadcrumb-item active">Order List v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    Order List
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-responsive-sm w-100 table-sm" id="order_list">
                                    <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>User Name</th>
                                        <th>Vendor Name</th>
                                        <th>Order Number</th>
                                        <th>Payment Status</th>
                                        <th>Total Amount</th>
                                        <th>Total Quantity</th>
                                        <th>Total Point</th>
                                        <th>Order Status</th>
                                        <th>Date</th>
                                        <th style="width: 100px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order_lists as $order)
                                        <tr class="text-center">
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$order->customer_name}}</td>
                                            <td>{{$order->vendor_name}}</td>
                                            <td>{{$order->order_id}}</td>
                                            <td>
                                                @if($order->is_paid == 0)
                                                    <span class="badge badge-warning">Due</span>
                                                @else
                                                    <span class="badge badge-success">Paid</span>
                                                @endif
                                            </td>
                                            <td>{{$order->total_price}}</td>
                                            <td>{{$order->total_qty}}</td>
                                            <td>{{$order->total_point}}</td>
                                            <td>
                                                @if($order->status == 0)
                                                    <span class="badge badge-warning">Pending</span>
                                                @else
                                                    <span class="badge badge-success">Success</span>
                                                @endif
                                            </td>
                                            <td>{{$order->created_at}}</td>
                                            <td>
                                                <a href="" class="btn btn-success">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <script>
        const dataTable = $('#order_list').DataTable({});
    </script>
@endsection
