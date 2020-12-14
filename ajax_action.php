<?php 
    include "connect.php";
    //them
    if (isset($_POST['makh'])) {
        $makh=$_POST['makh'];
        $hovaten = $_POST['hovaten'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $diachi = $_POST['diachi'];
        // $sql= "INSERT INTO `khachhang` (MAKH, HOTEN, MATKHAU, EMAIL, SDT, DIACHI) VALUES ('$makh', '$hovaten', '$matkhau', '$email', '$phone', '$diachi')";
        $result=mysqli_query($con, "INSERT INTO KHACHHANG (`MAKH`, `HOTEN`, `EMAIL`, `SDT`, `DIACHI`) VALUES ('$makh', '$hovaten', '$email', '$phone', '$diachi')");
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
        }
    };
?>
