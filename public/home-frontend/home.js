$(function () {
    $('.add-to-cart').on('click', addToCart);
    $('.update-carts').on('click', updateCart);
    $('.delete-carts').on('click', deleteCart);
});


function addToCart(event) {
    event.preventDefault();
    let url = $(this).data('url');

    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: url,
        success: function (data) {
            if (data.code == 200) {
                alertify.success('Thêm vào giỏ hàng thành công');
                if (data.cartNumber > 0) {
                    $('#span-cart').html(data.cartNumber);
                }
            }
        },
        error: function () {

        }
    });
};


function deleteCart(event) {
    event.preventDefault();
    let url = $(this).data('url');
    $.ajax({
        type: 'GET',
        url: url,
        success: function (data) {
            if (data.code === 200) {
                $('.cart-wrapper').html(data.cart_component);

                if (data.cartNumber != null) {
                    $('#span-cart').html(data.cartNumber);
                }
            }
        },
        error: function () {

        }
    });

}

function updateCart(event) {
    event.preventDefault();
    let urlCart = $('.update-cart-url').data('url');
    let idCart = $(this).data('id');
    let quantity = $(this).parents('tr').find('input.quantity').val();
    $.ajax({
        type: 'GET',
        url: urlCart,
        data: {id: idCart, quantity: quantity},
        success: function (data) {
            if (data.code === 200) {
                Swal.fire('Cập nhật thành công!')
                // console.log(data.cart_component);
                $('.cart-wrapper').html(data.cart_component);
            }
        },
        error: function () {

        }
    });
}
