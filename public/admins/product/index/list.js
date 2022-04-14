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
            // Swal.fire(
            //     'Deleted!',
            //     'Your file has been deleted.',
            //     'success'
            // )
        }
    })
}

$(function () {
    $(document).on('click', '.action_delete', actionDelete);
});
