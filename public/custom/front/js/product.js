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
            $('.view-add-group').empty()
            $('.view-add-group').append('<button onclick="AddToCart('+data.data.id+')" class="btn btn-success" title="Add to Cart" ><i\n' +
                '                                        class="fas fa-shopping-basket"></i><span>add to cart</span></button>');
            $('#pr_image').attr('src', '/storage/product/'+data.data.product_details.photo);
            $('#product-view').modal('show')
        },
        error: function (data) {
            toastr.error(data.responseJSON.message)

        }
    });
}
function AddToCart(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let  my_url = base + "/add-to-cart/" + id;
    $.ajax({
        type: 'get',
        url: my_url,
        success: (data) => {
            $('.t_cart_item').text(data.data.length+'+')
            let total = 0;
            let sub = 0
            $('.cart-list').empty();
            data.data.forEach((element, index) => {
                total += element.price * element.quantity
                $('.cart-list').append(' <li class="cart-item">\n' +
                    '            <div class="cart-media"><a href="javascript:void(0)" ><img src="'+element.image+'" alt="product"></a>\n' +
                    '                <button class="cart-delete" onclick="RemoveToCart('+element.id+')"><i class="far fa-trash-alt"></i></button>\n' +
                    '            </div>\n' +
                    '            <div class="cart-info-group">\n' +
                    '                <div class="cart-info"><h6><a href="product-single.html">'+element.name+'</a></h6>\n' +
                    '                    <p>Unit Price - '+element.price+' Tk</p>' +
                    '                    <p>Unit Point - '+element.point+' Point</p>' +
                    '                 </div>\n' +
                    '                <div class="cart-action-group">\n' +
                    '                    <div class="product-action">\n' +
                    '                        <button class="action-minus" onclick="DecreaseToCart('+element.id+')" title="Quantity Minus"><i class="icofont-minus"></i></button>\n' +
                    '                        <input class="action-input" title="Quantity Number" type="text" name="quantity" value="'+element.quantity+'">\n' +
                    '                        <button class="action-plus" onclick="AddToCart('+element.id+')" title="Quantity Plus"><i class="icofont-plus"></i></button>\n' +
                    '                    </div>\n' +
                    '                     <h6>'+element.price * element.quantity+' Tk</h6></div>\n' +
                    '            </div>\n' +
                    '        </li>')
                sub += element.price * element.quantity
            })
            $('#t_cart_price').text(total+' Tk')
            $('.checkout-price').text(sub+' Tk')
            //toastr.success(data.message)
        },
        error: function (data) {
            toastr.error(data.responseJSON.message)

        }
    });
}
function DecreaseToCart(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let  my_url = base + "/decrease/" + id;
    $.ajax({
        type: 'get',
        url: my_url,
        success: (data) => {
            $('.t_cart_item').text(data.data.length+'+')
            let total = 0;
            let sub = 0
            $('.cart-list').empty();
            data.data.forEach((element, index) => {
                total += element.price * element.quantity
                $('.cart-list').append(' <li class="cart-item">\n' +
                    '            <div class="cart-media"><a href="javascript:void(0)" ><img src="'+element.image+'" alt="product"></a>\n' +
                    '                <button class="cart-delete" onclick="RemoveToCart('+element.id+')"><i class="far fa-trash-alt"></i></button>\n' +
                    '            </div>\n' +
                    '            <div class="cart-info-group">\n' +
                    '                <div class="cart-info"><h6><a href="product-single.html">'+element.name+'</a></h6>\n' +
                    '                    <p>Unit Price - '+element.price+' Tk</p>' +
                    '                    <p>Unit Point - '+element.point+' Point</p>' +
                    '                 </div>\n' +
                    '                <div class="cart-action-group">\n' +
                    '                    <div class="product-action">\n' +
                    '                        <button class="action-minus" onclick="DecreaseToCart('+element.id+')" title="Quantity Minus"><i class="icofont-minus"></i></button>\n' +
                    '                        <input class="action-input" title="Quantity Number" type="text" name="quantity" value="'+element.quantity+'">\n' +
                    '                        <button class="action-plus" onclick="AddToCart('+element.id+')" title="Quantity Plus"><i class="icofont-plus"></i></button>\n' +
                    '                    </div>\n' +
                    '                    <h6>'+element.price * element.quantity+' Tk</h6></div>\n' +
                    '            </div>\n' +
                    '        </li>')
                sub += element.price * element.quantity
            })
            $('#t_cart_price').text(total+' Tk')
            $('.checkout-price').text(sub+' Tk')
          //  toastr.success(data.message)
        },
        error: function (data) {
            toastr.error(data.responseJSON.message)

        }
    });
}
function RemoveToCart(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let  my_url = base + "/remove/" + id;
    $.ajax({
        type: 'get',
        url: my_url,
        success: (data) => {
            $('.t_cart_item').text(data.data.length+'+')
            let total = 0;
            let sub = 0
            $('.cart-list').empty();
            data.data.forEach((element, index) => {
                total += element.price * element.quantity
                $('.cart-list').append(' <li class="cart-item">\n' +
                    '            <div class="cart-media"><a href="javascript:void(0)"><img src="'+element.image+'" alt="product"></a>\n' +
                    '                <button class="cart-delete"  onclick="RemoveToCart('+element.id+')"><i class="far fa-trash-alt"></i></button>\n' +
                    '            </div>\n' +
                    '            <div class="cart-info-group">\n' +
                    '                <div class="cart-info"><h6><a href="product-single.html">'+element.name+'</a></h6>\n' +
                    '                    <p>Unit Price - '+element.price+' Tk</p>' +
                    '                    <p>Unit Point - '+element.point+' Point</p>' +
                    '                 </div>\n' +
                    '                <div class="cart-action-group">\n' +
                    '                    <div class="product-action">\n' +
                    '                        <button class="action-minus" onclick="DecreaseToCart('+element.id+')" title="Quantity Minus"><i class="icofont-minus"></i></button>\n' +
                    '                        <input class="action-input" title="Quantity Number" type="text" name="quantity" value="'+element.quantity+'">\n' +
                    '                        <button class="action-plus" onclick="AddToCart('+element.id+')" title="Quantity Plus"><i class="icofont-plus"></i></button>\n' +
                    '                    </div>\n' +
                    '                    <h6>'+element.price * element.quantity+' Tk</h6></div>\n' +
                    '            </div>\n' +
                    '        </li>')
                sub += element.price * element.quantity
            })
            $('#t_cart_price').text(total+' Tk')
            $('.checkout-price').text(sub+' Tk')
           // toastr.success(data.message)
        },
        error: function (data) {
            toastr.error(data.responseJSON.message)

        }
    });
}
function GetCart(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let  my_url = base + "/get-cart";
    $.ajax({
        type: 'get',
        url: my_url,
        success: (data) => {
            $('.t_cart_item').text(data.data.length+'+')
            let total = 0;
            let sub = 0
            $('.cart-list').empty();
            data.data.forEach((element, index) => {
                total += element.price * element.quantity
                $('.cart-list').append(' <li class="cart-item">\n' +
                    '            <div class="cart-media"><a href="javascript:void(0)" ><img src="'+element.image+'" alt="product"></a>\n' +
                    '                <button class="cart-delete" onclick="RemoveToCart('+element.id+')"><i class="far fa-trash-alt"></i></button>\n' +
                    '            </div>\n' +
                    '            <div class="cart-info-group">\n' +
                    '                <div class="cart-info"><h6><a href="product-single.html">'+element.name+'</a></h6>\n' +
                    '                    <p>Unit Price - '+element.price+' Tk</p>' +
                    '                    <p>Unit Point - '+element.point+' Point</p>' +
                    '                 </div>\n' +
                    '                <div class="cart-action-group">\n' +
                    '                    <div class="product-action">\n' +
                    '                        <button class="action-minus" onclick="DecreaseToCart('+element.id+')" title="Quantity Minus"><i class="icofont-minus"></i></button>\n' +
                    '                        <input class="action-input" title="Quantity Number" type="text" name="quantity" value="'+element.quantity+'">\n' +
                    '                        <button class="action-plus" onclick="AddToCart('+element.id+')" title="Quantity Plus"><i class="icofont-plus"></i></button>\n' +
                    '                    </div>\n' +
                    '                    <h6>'+element.price * element.quantity+' Tk</h6></div>\n' +
                    '            </div>\n' +
                    '        </li>')
                sub += element.price * element.quantity
            })
            $('#t_cart_price').text(total+' Tk')
            $('.checkout-price').text(sub+' Tk')
        },
        error: function (data) {
            toastr.error(data.responseJSON.message)

        }
    });

}
GetCart()
