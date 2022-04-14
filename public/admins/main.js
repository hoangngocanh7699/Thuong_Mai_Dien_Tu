function actionDelete(event) {
    event.preventDefault(); // ngan khong cho nut Delete di toi link, van giu nguyen trang web
    let urlRequest = $(this).data('url');
    let that = $(this);
    Swal.fire({
        title: 'Bạn có chắc không?',
        text: "Bạn sẽ không thể hoàn nguyên điều này!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Có, xóa nó!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'GET',
                url: urlRequest,
                success: function (data) {
                    if(data.code ==200){
                        that.parent().parent().remove();
                    }
                },
                error: function () {

                }
            });
            //Swal.fire(
               // 'Deleted!',
             //   'Your file has been deleted.',
              //  'success'
           // )
        }
    })
}

function actionCheckedStatusOrder(event) {
    event.preventDefault(); // ngan khong cho nut Delete di toi link, van giu nguyen trang web
    let urlRequest = $(this).data('url');
    let that = $(this);
    Swal.fire({
        title: 'Bạn có chắc xác nhận hoàn thành đơn hàng này không?',
        text: "Bạn sẽ không thể hoàn nguyên điều này!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Có, tôi chắc!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'GET',
                url: urlRequest,
                success: function (data) {
                    if(data.code ==200){
                        $('#order_status').html('Đã xử lý');
                    }
                },
                error: function () {

                }
            });
            //Swal.fire(
            // 'Deleted!',
            //   'Your file has been deleted.',
            //  'success'
            // )
        }
    })
}


$(function () {
    $(document).on('click', '.action_delete', actionDelete);
    $(document).on('click', '.action_checked_status_order', actionCheckedStatusOrder);
});

$(document).ready(function() {
    $('#myInput').on('keyup', function(event) {
        event.preventDefault();
        /* Act on the event */
        var tukhoa = $(this).val().toLowerCase();
        $('#myTable tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(tukhoa)>-1);
        });

    });
});
