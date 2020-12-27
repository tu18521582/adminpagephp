<?php 
    include "connect.php";
    session_start();
    //them
    if (isset($_POST['hovaten'])) {
        echo 'sad';
        $hovaten = $_POST['hovaten'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $diachi = $_POST['diachi'];
        $result=mysqli_query($con, "INSERT INTO KHACHHANG (`MAKH`, `HOTEN`, `EMAIL`, `SDT`, `DIACHI`) VALUES ('', '$hovaten', '$email', '$phone', '$diachi')");
        if($result) {
            echo $result;
        }
    }

    //delete

    if (isset($_POST['makh'])) {
        $makh = $_POST['makh'];

        $result = mysqli_query($con, "DELETE FROM KHACHHANG WHERE MAKH='$makh'");
    }


    //update
    if (isset($_POST['makhUpdate'])){
        $makhUpdate = $_POST['makhUpdate'];
        $hovatenUpdate = $_POST['hovatenUpdate'];
        $emailUpdate = $_POST['emailUpdate'];
        $phoneUpdate = $_POST['phoneUpdate'];
        $diachiUpdate = $_POST['diachiUpdate'];
        
        $result = mysqli_query($con, "UPDATE KHACHHANG SET HOTEN='$hovatenUpdate',EMAIL='$emailUpdate',SDT='$phoneUpdate',DIACHI='$diachiUpdate' WHERE MAKH='$makhUpdate'");

    }


    //hoa don
    //chi tiet hoa don
    if (isset($_POST['mahd'])){
        $mahd = $_POST['mahd'];
        $sql = "select * from cthd where mahd='$mahd'";
        $result = mysqli_query($con, "select * from cthd where mahd='$mahd'");
        $idNguoiDuyet = mysqli_fetch_row(mysqli_query($con, "select idnguoiduyet from hoadon where mahd='$mahd'"));
        // $selecthd = mysqli_query($con,"select hoten from hoadon where mahd='$mahd'");
        // $rownd=mysqli_fetch_row($selecthd);
        if ($idNguoiDuyet) {
            settype($idNguoiDuyet[0], "integer");
            $querySQL = "SELECT hoten from user where userid=$idNguoiDuyet[0]";
            $hotennguoiduyet = mysqli_fetch_row(mysqli_query($con, $querySQL));
        }
        while ($row = mysqli_fetch_row($result)) {
            echo "
                <label>Mã hóa đơn</label>
                <input type='text' class='form-control' id='mahdModal' value='$row[0]' disabled>
                <label>Mã sản phẩm</label>
                <input type='text' class='form-control' id='maspMpdal' value='$row[1]' disabled>
                <label>Số lượng</label>
                <input type='text' class='form-control' id='soluongModal' value='$row[2]' disabled>
                <label>Size</label>
                <input type='text' class='form-control' id='sizeModal' value='$row[3]' disabled>
            ";
            if ($hotennguoiduyet) {
                echo "<label>Người duyệt</label>
                <input type='text' class='form-control' id='sizeModal' value='$hotennguoiduyet[0]' disabled>";
            }
        }
    };


    //xu ly anh
    if (isset($_POST['tensp'])) {
        $tensp = $_POST['tensp'];
        $maloai = $_POST['maloai'];
        $hinh = $_POST['hinh'];
        $mota = $_POST['mota'];
        $gia = $_POST['gia'];
        $soluong = $_POST['soluong'];
        
        $result=mysqli_query($con, "INSERT INTO sanpham VALUES ('', '$tensp', '$maloai', '$hinh', '','','','','$mota','$gia','$soluong')");
    }

    //xoa san pham
    if (isset($_POST['masp'])) {
        $masp = $_POST['masp'];

        $result = mysqli_query($con, "DELETE FROM SANPHAM WHERE MASP='$masp'");
    }

    //update sp
    if (isset($_POST['maspUpdate'])) {
        $maspUpdate = $_POST['maspUpdate'];
        $tenspUpdate = $_POST['tenspUpdate'];
        $maloaiUpdate = $_POST['maloaiUpdate'];
        $motaUpdate = $_POST['motaUpdate'];
        $giaUpdate = (int)$_POST['giaUpdate'];
        $soluongUpdate = $_POST['soluongUpdate'];
        $hinhanhUpdate = $_POST['hinhanhUpdate'];
        if ($hinhanhUpdate=='null') {
            $sql = "UPDATE sanpham SET TENSP='$tenspUpdate', MALOAI='$maloaiUpdate', MOTA='$motaUpdate', GIA=$giaUpdate, SOLUONG='$soluongUpdate' WHERE MASP='$maspUpdate'";
            $result = mysqli_query($con,$sql);
            var_dump($sql);exit;
        }
        else {
            $sql = "UPDATE sanpham SET TENSP='$tenspUpdate', MALOAI='$maloaiUpdate', MOTA='$motaUpdate', GIA='$giaUpdate', SOLUONG='$soluongUpdate', HINHCHINH='$hinhanhUpdate' WHERE MASP='$maspUpdate'";
            $result = mysqli_query($con,$sql);
        }
    }

    //duyet don hang
    if (isset($_POST['duyetid'])) {
        $id = $_POST['duyetid'];
        $nguoiduyet = $_POST['idnguoiduyet'];
        $result = mysqli_query($con, "UPDATE hoadon SET trangthai=1 where mahd='$id'");
        $rs = mysqli_query($con, "UPDATE hoadon SET idnguoiduyet=$nguoiduyet where mahd='$id'");
    }

    //log out
    if (isset($_POST['logout'])) {
        session_destroy();
    }

    //chi tiet tai khoan

    if (isset($_POST['userid'])) {
        $userid = $_POST['userid'];
        $result = mysqli_query($con, "select * from user where userid='$userid'");
        while ($row = mysqli_fetch_row($result)) {
            echo "
                <label>Mã tài khoản</label>
                <input type='text' class='form-control' id='mahdModal' value='$row[0]' disabled>
                <label>Mã khách hàng</label>
                <input type='text' class='form-control' id='maspMpdal' value='$row[1]' disabled>
                <label>Tài khoản</label>
                <input type='text' class='form-control' id='soluongModal' value='$row[2]' disabled>
                <label>Mật khẩu</label>
                <input type='text' class='form-control' id='sizeModal' value='$row[3]' disabled>
                <label>Role</label>
                <input type='text' class='form-control' id='sizeModal' value='$row[4]' disabled>
                <label>Họ tên</label>
                <input type='text' class='form-control' id='sizeModal' value='$row[5]' disabled>
            ";
        }
    }
?>
