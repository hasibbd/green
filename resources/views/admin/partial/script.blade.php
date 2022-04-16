<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>

<!-- Datatables -->
<script src="{{asset('plugins/dt/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/dt/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist/js/pages/dashboard.js')}}"></script>

<!-- Sweet Alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!--Toaster-->
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{asset('custom/js/admin.js')}}"></script>
@switch(Request::segment(1))
    @case('sliders')
    <script src="{{asset('custom/js/slider.js')}}"></script> @break
    @case('category')
    <script src="{{asset('custom/js/category.js')}}"></script> @break
    @case('brand')
    <script src="{{asset('custom/js/brand.js')}}"></script> @break
    @case('article')
    <script src="{{asset('custom/js/article.js')}}"></script> @break
    @case('unit')
    <script src="{{asset('custom/js/unit.js')}}"></script> @break
    @case('product-list')
    <script src="{{asset('custom/js/product.js')}}"></script> @break
    @case('vendor-product-list')
    <script src="{{asset('custom/js/vendor_product.js')}}"></script> @break
    @case('my-product-list')
    <script src="{{asset('custom/js/my_product.js')}}"></script> @break
    @case('setting')
    <script src="{{asset('custom/js/setting.js')}}"></script> @break
    @case('flying-user-list')
    <script src="{{asset('custom/js/user.js')}}"></script> @break
    @case('admin-user-list')
    <script src="{{asset('custom/js/user.js')}}"></script> @break
    @case('store-user-list')
    <script src="{{asset('custom/js/store-user.js')}}"></script> @break
    @case('user-application-list')
    <script src="{{asset('custom/js/user-application.js')}}"></script> @break
    @case('store-application-list')
    <script src="{{asset('custom/js/store-application.js')}}"></script> @break
    @case('seller-order-list')
    <script src="{{asset('custom/js/seller-order.js')}}"></script> @break
@endswitch
<script>
    $(function () {
        $('.data_table').DataTable();
    });
</script>
@switch(Request::segment(1))
    @case('sliders')
    <script>
        $(function () {
            $("#slider").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('sliders.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'photo', name: 'photo'},
                    {data: 'title', name: 'title'},
                    {data: 'sort', name: 'sort'},
                    {data: 'detail', name: 'detail'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script> @break
    @case('category')
    <script>
        $(function () {
            $("#category").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('category.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'photo', name: 'photo'},
                    {data: 'title', name: 'title'},
                    {data: 'sort', name: 'sort'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        })
    </script> @break
    @case('brand')
    <script>
        $(function () {
            $("#brand").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('brand.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'photo', name: 'photo'},
                    {data: 'title', name: 'title'},
                    {data: 'sort', name: 'sort'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        })
    </script> @break
    @case('article')
    <script>
        $(function () {
            $("#article").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('article.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'photo', name: 'photo'},
                    {data: 'title', name: 'title'},
                    {data: 'sort', name: 'sort'},
                    {data: 'details', name: 'details'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script> @break
    @case('unit')
    <script>
        $(function () {
            $("#unit").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('unit.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script> @break
    @case('product-list')
    <script>
        $(function () {
            $("#product").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('product-list.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'photo', name: 'photo'},
                    {data: 'name', name: 'name'},
                    {data: 'unit.name', name: 'unit.name'},
                    {data: 'category.title', name: 'category.title'},
                    {data: 'brand.title', name: 'brand.title'},
                    {data: 'short_detail', name: 'short_detail'},
                    {data: 'reserve', name: 'reserve'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script> @break

    @case('vendor-product-list')
    <script>
        $(function () {
            $("#vendor-product").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('vendor.product.list.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'photo', name: 'photo'},
                    {data: 'name', name: 'name'},
                    {data: 'unit', name: 'unit'},
                    {data: 'category', name: 'category'},
                    {data: 'brand', name: 'brand'},
                    {data: 'vendor_price', name: 'vendor_price'},
                    {data: 'sell_price', name: 'sell_price'},
                    {data: 'point', name: 'point'},
                    {data: 'stock', name: 'stock'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script> @break
    @case('my-product-list')
    <script>
        $(function () {
            $("#my-product-list").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('my.product.list.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'photo', name: 'photo'},
                    {data: 'p_name', name: 'p_name'},
                    {data: 'unit_name', name: 'unit_name'},
                    {data: 'category_name', name: 'category_name'},
                    {data: 'brand_name', name: 'brand_name'},
                    {data: 'vendor_price', name: 'vendor_price'},
                    {data: 'sell_price', name: 'sell_price'},
                    {data: 'action', name: 'action'},
                ]
            });
        });
    </script> @break
    @case('flying-user-list')
    <script>
        $(function () {
            $("#flying_user").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('flying-user-list.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'photo', name: 'photo'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action'},
                ]
            });
        });
    </script> @break

    @case('store-user-list')
    <script>
        $(function () {
            $("#store_user").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('store-user-list.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'photo', name: 'photo'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'type', name: 'type'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action'},
                ]
            });
        });
    </script> @break

    @case('user-list')
    <script>
        $(function () {
            $("#user_list").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('user-list.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'photo', name: 'photo'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action'},
                ]
            });
        });
    </script> @break

    @case('admin-user-list')
    <script>
        $(function () {
            $("#admin_user").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin-user-list.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'photo', name: 'photo'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action'},
                ]
            });
        });
    </script> @break
    @case('order-list')
    <script>
        $(function () {
            $("#order_list").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('order-list.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'customer_name', name: 'customer_name'},
                    {data: 'vendor_name', name: 'vendor_name'},
                    {data: 'order_id', name: 'order_id'},
                    {data: 'is_paid', name: 'is_paid'},
                    {data: 'total_price', name: 'total_price'},
                    {data: 'total_qty', name: 'total_qty'},
                    {data: 'total_point', name: 'total_point'},
                    {data: 'status', name: 'status'},
                    {data: 'date', name: 'date'},
                    {data: 'action', name: 'action'},
                ]
            });
        });
    </script> @break
    @case('order-details')
    <script>
        $(function () {
            $("#order_details").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('order-details.index') }}",
                    data: function (d) {
                        d.param = window.location.href.replace(/.*\/(\w+)\/?$/, '$1')
                    }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'customer_name', name: 'customer_name'},
                    {data: 'vendor_name', name: 'vendor_name'},
                    {data: 'order_id', name: 'order_id'},
                    {data: 'is_paid', name: 'is_paid'},
                    {data: 'total_price', name: 'total_price'},
                    {data: 'total_qty', name: 'total_qty'},
                    {data: 'total_point', name: 'total_point'},
                    {data: 'status', name: 'status'},
                    {data: 'date', name: 'date'},
                    {data: 'action', name: 'action'},
                ]
            });
        });
    </script> @break
    @case('setting')
    <script>
        $(function () {
            $("#point_rate").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('setting.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'title', name: 'ttile'},
                    {data: 'point_rate', name: 'point_rate'},
                    {data: 'action', name: 'action'},
                ]
            });
        });
    </script> @break
    @case('user-application-list')
    <script>
        $(function () {
            $("#user_application_list").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('user-application-list.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'photo', name: 'photo'},
                    {data: 'user.name', name: 'name'},
                    {data: 'user.email', name: 'email'},
                    {data: 'user.phone', name: 'phone'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action'},
                ]
            });
        });
    </script> @break
    @case('store-application-list')
    <script>
        $(function () {
            $("#store_application_list").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('store-application-list.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'photo', name: 'photo'},
                    {data: 'user.name', name: 'name'},
                    {data: 'user.email', name: 'email'},
                    {data: 'user.phone', name: 'phone'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action'},
                ]
            });
        });
    </script> @break

@endswitch

