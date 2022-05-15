$(document).ready(function () {

    var base = window.location.origin;
    function loading(type,text) {
        if (type == 'on'){
            $('.load').prop("disabled",true).html('<span class="spinner-border spinner-border-sm mr-3" role="status" aria-hidden="true"></span>'+text);
        }else{
            $('.load').prop("disabled",false).text(text);
        }
    }
    function formReset(){
        $(".select2bs4").val(null).trigger('change');
        $(".select2").val(null).trigger('change');
        $('.modal').modal('hide');
        $('form').trigger("reset");
        $("formId")[0].reset()
    }

    $('#profile_info_change').submit(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        if ($('#password').val() === $('#c_password').val()){
            loading('on','Wait...')
            let formData = new FormData(this);
            let  my_url = base + "/profile-info-change";
            $.ajax({
                type: 'post',
                url: my_url,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    loading('off','Submit')
                    toastr.success(data.message)
                    $("#p_name").text(data.data.name);
                    $("#p_email").text(data.data.email);
                    $("#name").text(data.data.name);
                    $("#email").text(data.data.email);
                    $("#p_image").attr('src','storage/user/'+data.data.photo);
                 //   $(".pro_info").load(location.href + " .pro_info");
                 //   $(".pro_info2").load(location.href + " .pro_info2");
                 ///   formReset();
                },
                error: function (data) {
                    loading('off','Submit')
                    toastr.error(data.responseJSON.message)

                }
            });
        }else{
            toastr.error('Password did not match')
        }
    });

});

function Details(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var base = window.location.origin;
    let  my_url = base + "/admin-seller-order-list-details/" + id;
    $.ajax({
        type: 'get',
        url: my_url,
        success: (data) => {
            LoadDetails(data.data)
            $('#add_modal').modal('show');
        },
        error: function (data) {
            toastr.error(data.responseJSON.message)

        }
    });
}
function LoadDetails(data) {
    $('#seller_order tbody').empty();
    data.forEach((element, index) => {
        let btn =   '<button class="btn btn-sm btn-success mr-2" onclick="Deliver('+element.id+')"><i class="fas fa-check-circle"></i></button>'
        let btn2 =   '<button class="btn btn-sm btn-danger" onclick="Cancel('+element.id+')"><i class="fas fa-times-circle"></i></button>'
        if (element.status !== 0){
            btn = ''
            btn2 = ''
            if (element.status !== 0 && element.status < 2){
                btn = '<button class="btn btn-sm btn-success mr-2">Wait for Confirmation</button>'
            }
        }
        $('#seller_order tbody').append('<tr>' +
            '<td>'+element.vendor_details.product_details.name+'</td>' +
            '<td>'+element.vendor_details.product_details.brand.title+'</td>' +
            '<td>'+element.price+'</td>' +
            '<td>'+element.vendor_details.stock_details.reduce((accumulator, object) => {
                return accumulator + object.qty;
            }, 0)+'</td>' +
            '<td>'+element.qty+'</td>' +
            '</tr>');
    })
    // $('form').trigger("reset");
    $('#id').val(data.id);
}
