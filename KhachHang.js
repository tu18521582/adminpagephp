$(document).ready(function () {
    $(".delete").click(function () {
        var maKH = $(this).attr("iddelete");
        $(this).parent().parent().remove();
        $.post("XoaKhachHang.php",
            {
                makhachhang: maKH
            },
            function (data, status) {

            });
    });
});