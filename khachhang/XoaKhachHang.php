<?php 
        $maKH = $_GET['makhachhang'];
        include "connect.php";
        $str = "delete from khachhang where MAKH='$makh'";
        echo $str;
        $connect->query($str);
?>