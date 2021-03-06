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
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let my_url = base + "/check-ref";
        $.ajax({
            type: 'get',
            data: {
                'user_id': $('#ref_user').val()
            },
            url: my_url,
            success: (data) => {
                let formData = new FormData(this);
                let my_url = base + "/store-user-store";
                $.ajax({
                    type: 'post',
                    url: my_url,
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        loading('off', 'Submit')
                        toastr.success(data.message)
                        formReset();
                    },
                    error: function (data) {
                        loading('off', 'Submit')
                        toastr.error(data.responseJSON.message)

                    }
                });
            },
            error: function (data) {
                toastr.error('Please check the referral user id')
            }
        });
    });
    $('#limit_submit').submit(function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let formData = new FormData(this);
        let  my_url = base + "/add-limit";
        $.ajax({
            type: 'post',
            url: my_url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                loading('off', 'Submit')
                toastr.success(data.message)
                $('.table').DataTable().ajax.reload();
                $('#user_id_limit').val(null);
                $('#limit').val(0);
                $('#limit_modal').modal('hide');
            },
            error: function (data) {
                loading('off', 'Submit')
                toastr.error(data.responseJSON.message)

            }
        });
    });
})
var base = window.location.origin;
function Status(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let  my_url = base + "/user-status/" + id;
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
                let  my_url = base + "/user-delete/" + id;
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
    let  my_url = base + "/user-show/" + id;
    $.ajax({
        type: 'get',
        url: my_url,
        success: (data) => {
            $('form').trigger("reset");
            $('#id').val(data.data.id);
            $('#name').val(data.data.name);
            $('#email').val(data.data.email);
            $('#phone').val(data.data.phone);
            $('#type').prop('checked', data.data.is_mobile_store)
            $('#previewImg').attr('src', '/storage/user/'+data.data.photo);
            $('#add_modal').modal('show');
        },
        error: function (data) {
            toastr.error(data.responseJSON.message)

        }
    });
}
function AddLimit(id) {
    $('#user_id_limit').val(id);
    $('#limit').val(0);
    $('#limit_modal').modal('show');
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
