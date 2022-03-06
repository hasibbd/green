@extends('admin.app.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">My Product</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{'vendor-dashboard'}}">Home</a></li>
                            <li class="breadcrumb-item active">My Product</li>
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
                                <div class="row">
                                    <div class="col">
                                        <div class="card-title">
                                            My Product
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover table-responsive-sm w-100 table-sm"
                                       id="my-product-list">
                                    <thead>
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Unit</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Vendor Price</th>
                                        <th>Sell Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($my_products as $my_product)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$my_product->p_photo}}</td>
                                            <td>{{$my_product->p_name}}</td>
                                            <td>{{$my_product->unit_name}}</td>
                                            <td>{{$my_product->category_name}}</td>
                                            <td>{{$my_product->brand_name}}</td>
                                            <td>{{$my_product->vendor_price}}</td>
                                            <td>{{$my_product->sell_price}}</td>
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
