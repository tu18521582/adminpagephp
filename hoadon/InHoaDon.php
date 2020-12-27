<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    

    <?php 
        include 'connect.php';
        $id = $_GET['id'];
        $order = mysqli_query($con, "SELECT hd.MAKH,hd.NGAYHD,hd.GIAMGIA,hd.THANHTIEN, hd.HOTEN, hd.SDT, hd.DIACHI, cthd.*, sp.TENSP, sp.GIA from 
        hoadon hd join cthd on hd.MAHD=cthd.MAHD join sanpham sp on cthd.masp=sp.MASP WHERE hd.mahd=$id");
        $orders = mysqli_fetch_all($order, MYSQLI_ASSOC);
    ?>

    <div class='bill'>
        <div>
            <img class='logo' src='https://cf.shopee.vn/file/88be918c0c357d9c0920b21a770ce5dc'/>
        </div>
        <div class='title'>
            HÓA ĐƠN THANH TOÁN
            <br />
            -------oOo-------
        </div>
        <span class='makh'>Mã khách hàng: </span><?= $orders[0]['MAKH'] ?>

        <span class='makh'>Ngày hóa đơn: </span>  <?= $orders[0]['NGAYHD'] ?>
        <br />

        <span class='makh'>Tên người nhận: </span><?= $orders[0]['HOTEN']?>
        <br />

        <span class='makh'>Số điện thoại: </span><?= $orders[0]['SDT']?>
        <br/>

        <span class='makh'>Địa chỉ:</span> <?= $orders[0]['DIACHI']?>
        <br/>
        <table >
            <thead>
                <tr>
                    <th>Tên</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $tongsotien = 0;
                    foreach ($orders as $i=>$row) {
                        $thanhtien = $row['GIA']*$row['SOLUONG'];
                        $tongsotien = $tongsotien + $thanhtien;
                        echo "
                        <tr>
                            <td>".$row['TENSP']."</td>
                            <td>".$row['GIA']."</td>
                            <td>".$row['SOLUONG']."</td>
                            <td>".$thanhtien."</td>
                        </tr>   
                        ";
                    }
                ?>
                
            </tbody>
        </table>
        <br />
        <span class='makh'>Tổng tiền: <?= $tongsotien ?> </span>
    </div>
</body>
</html>