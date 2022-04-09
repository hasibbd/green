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
                                <table class="table table-bordered table-responsive-sm w-100 table-sm data_table" >
                                    <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>User Name</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>User Name</th>
                                        <th style="width: 100px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order as $o)
                                        <tr class="text-center">
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$o->vendor_product}}</td>
                                            <td>{{$o->qty}}</td>
                                            <td>{{$o->price}}</td>
                                            <td>{{$o->status}}</td>
                                            <td>
                                                <a href="{{url('seller-order-list-details/'.$o->id)}}" class="btn btn-success">View</a>
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

@endsection
