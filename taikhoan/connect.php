<?php
    $connect = new mysqli('localhost','root','','doanweb');
    $con=mysqli_connect('localhost','root', '', 'doanweb');

    // if($connect->errno !== 0)
    // {
    //     die("Error: Could not connect to the database. An error ".$connect->error." ocurred.");
    // }
    // else {
    //     echo 'Connect success';
    // }
    //Chọn hệ ký tự là utf8 để có thể in ra tiếng Việt.
    $connect->set_charset('utf8'); //csdl tiếng việt
?>
