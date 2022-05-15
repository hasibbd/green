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

    $('#basic_submit').submit(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        loading('on','Wait...')
        let formData = new FormData(this);
        let  my_url = base + "/basic-update";
        $.ajax({
            type: 'post',
            url: my_url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
              //  $('.table').DataTable().ajax.reload();
                loading('off','Submit')
                toastr.success(data.message)
                formReset();
                location.reload()
            },
            error: function (data) {
                loading('off','Submit')
                toastr.error(data.responseJSON.message)

            }
        });
    });
    $('#store_app_submit').submit(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        loading('on','Wait...')
        let formData = new FormData(this);
        let  my_url = base + "/store-application-store";
        $.ajax({
            type: 'post',
            url: my_url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
              //  $('.table').DataTable().ajax.reload();
                loading('off','Submit')
                toastr.success(data.message)
                location.reload()
            },
            error: function (data) {
                loading('off','Submit')
                toastr.error(data.responseJSON.message)

            }
        });
    });
    $('#pass_change').submit(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        if ($('#r_pass').val() == $('#n_pass').val()){
            loading('on','Wait...')
            let formData = new FormData(this);
            let  my_url = base + "/pass-update";
            $.ajax({
                type: 'post',
                url: my_url,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    //  $('.table').DataTable().ajax.reload();
                    loading('off','Submit')
                    toastr.success(data.message)
                    formReset();
                    location.reload()
                },
                error: function (data) {
                    loading('off','Submit')
                    toastr.error(data.responseJSON.message)

                }
            });
        }else{
            toastr.error('New password and Repeat password is not matched')
        }
    });
});
var base = window.location.origin;
function Status(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let  my_url = base + "/brand-status/" + id;
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
function CheckUser() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#r_name').val(null)
    let code = $('#r_code').val();
    if (code.length > 5){
        let  my_url = base + "/check-code/" + code;
        $.ajax({
            type: 'get',
            url: my_url,
            success: (data) => {
                $('#r_name').val(data.data.name)
               // toastr.success(data.message)
            },
            error: function (data) {
                toastr.error(data.responseJSON.message)

            }
        });
    }

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
                let  my_url = base + "/brand-delete/" + id;
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
function Show(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let  my_url = base + "/brand-show/" + id;
    $.ajax({
        type: 'get',
        url: my_url,
        success: (data) => {
            $('form').trigger("reset");
            $('#id').val(data.data.id);
            $('#title').val(data.data.title);
            $('#details').val(data.data.detail);
            $('#sort').val(data.data.sort);
            $('#previewImg').attr('src', '/storage/brand/'+data.data.photo);
            $('#add_modal').modal('show');
        },
        error: function (data) {
            toastr.error(data.responseJSON.message)

        }
    });
}
function previewFile(input){
    var file = $("input[type=file]").get(0).files[0];

    if(file){
        var reader = new FileReader();

        reader.onload = function(){
            $("#previewImg").attr("src", reader.result);
        }

        reader.readAsDataURL(file);
    }
}
function Accept(id) {
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
                let  my_url = base + "/product-accept/" + id;
                $.ajax({
                    type: 'get',
                    url: my_url,
                    success: (data) => {
                       // $("#AllATble").load(location.href + " #AllATble");
                        swal("Poof! Your imaginary file has been canceled!", {
                            icon: "success",
                        });
                        location.reload()
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
