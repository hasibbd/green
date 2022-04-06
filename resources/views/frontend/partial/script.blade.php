<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="{{asset('frontend/vendor/bootstrap/popper.min.js')}}"></script>
<script src="{{asset('frontend/vendor/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/vendor/countdown/countdown.min.js')}}"></script>
<script src="{{asset('frontend/vendor/niceselect/nice-select.min.js')}}"></script>
<script src="{{asset('frontend/vendor/slickslider/slick.min.js')}}"></script>
<script src="{{asset('frontend/vendor/venobox/venobox.min.js')}}"></script>
<script src="{{asset('frontend/js/nice-select.js')}}"></script>
<script src="{{asset('frontend/js/countdown.js')}}"></script>
<script src="{{asset('frontend/js/accordion.js')}}"></script>
<script src="{{asset('frontend/js/venobox.js')}}"></script>
<script src="{{asset('frontend/js/slick.js')}}"></script>
<script src="{{asset('frontend/js/main.js')}}"></script>
<!-- Datatables -->
<script src="{{asset('plugins/dt/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/dt/datatables/js/dataTables.bootstrap4.min.js')}}"></script>

<!-- Sweet Alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!--Toaster-->
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script src="{{asset('custom/front/js/product.js')}}"></script>
<script src="{{asset('custom/front/js/my-profile.js')}}"></script>
<script src="{{asset('custom/front/plugin/xzoom.min.js')}}"></script>
<script src="{{asset('custom/front/plugin/setup.js')}}"></script>
<script>
    $(function () {

    })
</script>
@switch(Request::segment(1))
 @case('product')
 <script>
     $(function () {
         $("#product_list").DataTable({
             processing: true,
             serverSide: true,
             ajax: {
                 url: "{{ route('product.index') }}",
                 data: function (d) {
                     d.param = window.location.href.replace(/.*\/(\w+)\/?$/, '$1')
                 }
             },
             columns: [
                 {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'table-serial'},
                 {data: 'photo', name: 'photo', class: 'table-image'},
                 {data: 'product_details.name', name: 'product_details.name', class: 'table-name'},
                 {data: 'product_details.category_details.title', name: 'product_details.category_details.title', class: 'table-shop'},
                 {data: 'brand', name: 'brand', class: 'table-shop'},
                 {data: 'price', name: 'price', class: 'table-price'},
                 {data: 'points', name: 'points', class: 'table-serial'},
                 {data: 'vendor', name: 'vendor', class: 'table-vendor'},
                 {data: 'action', name: 'action', class: 'table-action'},
             ],
             "language": {
                 "paginate": {
                     "next": '<i class="fas fa-long-arrow-alt-right"></i>',
                     "previous": '<i class="fas fa-long-arrow-alt-left"></i>'
                 }
             }
         });
     });
 </script>
 @break
 @case('product-list')
 <script>
     $(function () {
         $("#sim_product_list").DataTable({
             processing: true,
             serverSide: true,
             ajax: {
                 url: "{{ route('productData.index') }}",
                 data: function (d) {
                     d.param = window.location.href.replace(/.*\/(\w+)\/?$/, '$1')
                 }
             },
             columns: [
                 {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'table-serial'},
                 {data: 'photo', name: 'photo', class: 'table-image'},
                 {data: 'product_details.name', name: 'product_details.name', class: 'table-name'},
                 {data: 'product_details.category_details.title', name: 'product_details.category_details.title', class: 'table-shop'},
                 {data: 'brand', name: 'brand', class: 'table-shop'},
                 {data: 'price', name: 'price', class: 'table-price'},
                 {data: 'points', name: 'points', class: 'table-serial'},
                 {data: 'vendor', name: 'vendor', class: 'table-vendor'},
                 {data: 'action', name: 'action', class: 'table-action'},
             ],
             "language": {
                 "paginate": {
                     "next": ">",
                     "previous": "<"
                 }
             }
         });
     });
 </script>
 @break
 @case('brand-products')
 <script>
     $(function () {
         $("#brand_list").DataTable({
             processing: true,
             serverSide: true,
             ajax: {
                 url: "{{ route('brand-product.index') }}",
                 data: function (d) {
                     d.param = window.location.href.replace(/.*\/(\w+)\/?$/, '$1')
                 }
             },
             columns: [
                 {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'table-serial'},
                 {data: 'photo', name: 'photo', class: 'table-image'},
                 {data: 'name', name: 'name', class: 'table-name'},
                 {data: 'category_details.title', name: 'category_details.title', class: 'table-shop'},
                 {data: 'brand_details.title', name: 'brand_details.title', class: 'table-shop'},
                 {data: 'action', name: 'action', class: 'table-action'},
             ],
             "language": {
                 "paginate": {
                     "next": ">",
                     "previous": "<"
                 }
             }
         });
     });
 </script>
 @break
@endswitch

