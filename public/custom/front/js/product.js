$(document).ready(function () {

    var base = window.location.origin;
});
var base = window.location.origin;
function viewProduct(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let  my_url = base + "/product-view/" + id;
    $.ajax({
        type: 'get',
        url: my_url,
        success: (data) => {
            $('form').trigger("reset");
            $('#id').val(data.data.id);
            $('.view-name').text(data.data.product_details.name);
            $('#pr_brand').text(data.data.product_details.brand_details.title);
            $('#pr_unit').text(data.data.product_details.unit_details.name);
            $('.view-desc').text(data.data.product_details.detail);
            $('#pr_price').text(data.data.sell_price);
            $('#pr_vendor').text(data.data.vendor.name);
            $('#pr_image').attr('src', '/storage/product/'+data.data.product_details.photo);
            $('#add_modal').modal('show');
        },
        error: function (data) {
            toastr.error(data.responseJSON.message)

        }
    });
    $('#product-view').modal('show')
}
