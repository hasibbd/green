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

    $('#form_submit').submit(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        loading('on','Wait...')
        let formData = new FormData(this);
        let  my_url = base + "/unit-store";
        $.ajax({
            type: 'post',
            url: my_url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                $('.table').DataTable().ajax.reload();
                loading('off','Submit')
                toastr.success(data.message)
                formReset();
            },
            error: function (data) {
                loading('off','Submit')
                toastr.error(data.responseJSON.message)

            }
        });
    });
});
var base = window.location.origin;
function Status(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let  my_url = base + "/unit-status/" + id;
    $.ajax({
        type: 'get',
        url: my_url,
        success: (data) => {
            $('.table').DataTable().ajax.reload();
            toastr.success(data.message)
        },
        error: function (data) {
            toastr.error(data.responseJSON.message)

        }
    });
}
function Delete(id) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this imaginary file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                let  my_url = base + "/unit-delete/" + id;
                $.ajax({
                    type: 'delete',
                    url: my_url,
                    success: (data) => {
                        $('.table').DataTable().ajax.reload();
                        swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                        });
                    },
                    error: function (data) {
                        toastr.error(data.responseJSON.message)

                    }
                });

            } else {
                swal("Your imaginary file is safe!");
            }
        });
}
function Details(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let  my_url = base + "/seller-order-list-details/" + id;
    $.ajax({
        type: 'get',
        url: my_url,
        success: (data) => {
            $('#o_no').val(data.data[0].order_main_id)
            LoadDetails(data.data)
            $('#add_modal').modal('show');
        },
        error: function (data) {
            toastr.error(data.responseJSON.message)

        }
    });
}
function previewFile(input){
    console.log(input)
    var file = $("input[type=file]").get(0).files[0];

    if(file){
        var reader = new FileReader();

        reader.onload = function(){
            $("#previewImg").attr("src", reader.result);
        }

        reader.readAsDataURL(file);
    }
}
function DeliverAll() {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this imaginary file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                const id = $('#o_no').val();
                let  my_url = base + "/product-deliver-all/" + id;
                $.ajax({
                    type: 'get',
                    url: my_url,
                    success: (data) => {
                        LoadDetails(data.data)
                        swal(data.message, {
                            icon: data.icon,
                        });
                    },
                    error: function (data) {
                        toastr.error(data.responseJSON.message)

                    }
                });

            } else {
                swal("Your imaginary file is safe!");
            }
        });
}
function Deliver(id) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this imaginary file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                let  my_url = base + "/product-deliver/" + id;
                $.ajax({
                    type: 'get',
                    url: my_url,
                    success: (data) => {
                        LoadDetails(data.data)
                        swal("Poof! Your imaginary file has been delivered!", {
                            icon: "success",
                        });
                    },
                    error: function (data) {
                        toastr.error(data.responseJSON.message)

                    }
                });

            } else {
                swal("Your imaginary file is safe!");
            }
        });
}
function Cancel(id) {
    swal({
        title: "Are you sure?",
        text: "Once Cancel, you will not be able to recover this imaginary file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                let  my_url = base + "/product-cancel/" + id;
                $.ajax({
                    type: 'get',
                    url: my_url,
                    success: (data) => {
                        LoadDetails(data.data)
                        swal("Poof! Your imaginary file has been canceled!", {
                            icon: "success",
                        });
                    },
                    error: function (data) {
                        toastr.error(data.responseJSON.message)

                    }
                });

            } else {
                swal("Your imaginary file is safe!");
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
        if (element.vendor_details.stock_details.reduce((accumulator, object) => {
            return accumulator + object.qty;
        }, 0) >= element.qty){

        }else{
            btn = ''
        }
        $('#seller_order tbody').append('<tr>' +
            '<td>'+element.vendor_details.product_details.name+'</td>' +
            '<td>'+element.vendor_details.product_details.brand.title+'</td>' +
            '<td>'+element.price+'</td>' +
            '<td>'+element.vendor_details.stock_details.reduce((accumulator, object) => {
                return accumulator + object.qty;
            }, 0)+'</td>' +
            '<td>'+element.qty+'</td>' +
            '<td>' +
              btn +
            btn2 +
            '</td>' +
            '</tr>');
    })
   // $('form').trigger("reset");
    $('#id').val(data.id);
}
