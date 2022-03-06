
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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
    @case('sliders') <script src="{{asset('custom/js/slider.js')}}"></script> @break
    @case('category') <script src="{{asset('custom/js/category.js')}}"></script> @break
    @case('brand') <script src="{{asset('custom/js/brand.js')}}"></script> @break
    @case('article') <script src="{{asset('custom/js/article.js')}}"></script> @break
    @case('unit') <script src="{{asset('custom/js/unit.js')}}"></script> @break
    @case('product-list') <script src="{{asset('custom/js/product.js')}}"></script> @break
    @case('vendor-product-list') <script src="{{asset('custom/js/vendor_product.js')}}"></script> @break
    @case('my-product-list') <script src="{{asset('custom/js/my_product.js')}}"></script> @break
@endswitch

@switch(Request::segment(1))
    @case('sliders') <script>
        $(function () {
            $("#slider").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('sliders.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
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
    @case('category') <script>
        $(function () {
            $("#category").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('category.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'photo', name: 'photo'},
                    {data: 'title', name: 'title'},
                    {data: 'sort', name: 'sort'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        })
    </script> @break
    @case('brand') <script>
        $(function () {
            $("#brand").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('brand.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'photo', name: 'photo'},
                    {data: 'title', name: 'title'},
                    {data: 'sort', name: 'sort'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        })
    </script> @break
    @case('article') <script>
        $(function () {
            $("#article").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('article.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
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
    @case('unit') <script>
        $(function () {
            $("#unit").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('unit.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script> @break
    @case('product-list') <script>
        $(function () {
            $("#product").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('product-list.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'photo', name: 'photo'},
                    {data: 'name', name: 'name'},
                    {data: 'unit.name', name: 'unit.name'},
                    {data: 'category.title', name: 'category.title'},
                    {data: 'brand.title', name: 'brand.title'},
                    {data: 'short_detail', name: 'short_detail'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script> @break

    @case('vendor-product-list') <script>
        $(function () {
            $("#vendor-product").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('vendor.product.list.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'photo', name: 'photo'},
                    {data: 'name', name: 'name'},
                    {data: 'unit.name', name: 'unit.name'},
                    {data: 'category.title', name: 'category.title'},
                    {data: 'brand.title', name: 'brand.title'},
                    {data: 'short_detail', name: 'short_detail'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script> @break

@endswitch

