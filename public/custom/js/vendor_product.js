$(document).ready(function () {

    var base = window.location.origin;

    function loading(type, text) {
        if (type == 'on') {
            $('.load').prop("disabled", true).html('<span class="spinner-border spinner-border-sm mr-3" role="status" aria-hidden="true"></span>' + text);
        } else {
            $('.load').prop("disabled", false).text(text);
        }
    }

    function formReset() {
        $(".select2bs4").val(null).trigger('change');
        $(".select2").val(null).trigger('change');
        $('.modal').modal('hide');
        $('form').trigger("reset");
        $("formId")[0].reset()
    }

    $('#form_submit').submit(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        loading('on', 'Wait...')
        let formData = new FormData(this);
        let my_url = base + "/vendor-product-store";
        $.ajax({
            type: 'post',
            url: my_url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                $('.table').DataTable().ajax.reload();
                loading('off', 'Submit')
                toastr.success(data.message)
                formReset();
            },
            error: function (data) {
                loading('off', 'Submit')
                toastr.error(data.responseJSON.message)
            }
        });
    });
    $('#stock_submit').submit(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        loading('on', 'Wait...')
        let formData = new FormData(this);
        let my_url = base + "/vendor-product-stock";
        $.ajax({
            type: 'post',
            url: my_url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                $('.table').DataTable().ajax.reload();
                loading('off', 'Submit')
                toastr.success(data.message)
                formReset();
            },
            error: function (data) {
                loading('off', 'Submit')
                toastr.error(data.responseJSON.message)
            }
        });
    });
    $('#edit_submit').submit(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        loading('on', 'Wait...')
        let formData = new FormData(this);
        let my_url = base + "/vendor-product-edit";
        $.ajax({
            type: 'post',
            url: my_url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                $('.table').DataTable().ajax.reload();
                loading('off', 'Submit')
                toastr.success(data.message)
                formReset();
            },
            error: function (data) {
                loading('off', 'Submit')
                toastr.error(data.responseJSON.message)
            }
        });
    });
});
var base = window.location.origin;
function addProductForVendor(product_id) {
    console.log(product_id)
    $('#product_id').val(product_id);
    $('#add_modal').modal('show');
}

function AddStock(id) {
    $('#id').val(id);
    $('#stock_modal').modal('show');
}
function EditModal(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let  my_url = base + "/get-edit-product/"+id;
    $.ajax({
        type: 'get',
        url: my_url,
        success: (data) => {
            $('#e_id').val(data.data.id);
            $('#e_vendor_price').val(data.data.vendor_price);
            $('#e_sell_price').val(data.data.sell_price);
            $('#edit_modal').modal('show')
        },
        error: function (data) {
            toastr.error(data.responseJSON.message)

        }
    });

}
function OpenModal() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let  my_url = base + "/get-product";
    $.ajax({
        type: 'get',
        url: my_url,
        success: (data) => {
            $('#products').empty()
            data.data.forEach((element, index) => {
                $('#products').append('<option value="'+element.id+'">'+element.name+'</option>')
            })
            $('#add_modal').modal('show')
        },
        error: function (data) {
            toastr.error(data.responseJSON.message)

        }
    });

}
