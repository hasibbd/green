@extends('admin.app.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Setting</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{'dashboard'}}">Home</a></li>
                            <li class="breadcrumb-item active">Setting v1</li>
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
                                 <div class="col"><div class="card-title">
                                         Setting
                                     </div></div>
                                 <div class="col text-right">
                                     <button onclick="$('#add_modal').modal('show')" class="btn btn-sm btn-primary">Add New</button>
                                 </div>
                             </div>
                         </div>
                         <div class="card-body">
                           <div class="row">
                               <div class="col-md-6">
                                   Logo
                               </div>
                           </div>

                         </div>
                     </div>
                  </div>
              </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
