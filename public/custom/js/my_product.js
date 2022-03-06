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
});

function addProductForVendor(product_id) {
    $('#product_id').val(product_id);
    $('#add_modal').modal('show');
}
