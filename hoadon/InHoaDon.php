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
        $order = mysqli_query($con, "SELECT hd.MAKH,hd.NGAYHD,hd.GIAMGIA,hd.THANHTIEN, hd.TONGCONG, cthd.*, sp.TENSP, sp.GIA from 
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
        <span class='makh'>Mã khách hàng: <?= $orders[0]['MAKH'] ?></span>
        <br />
        <span class='makh'>Ngày hóa đơn: <?= $orders[0]['NGAYHD'] ?></span>
        <br />


        <table >
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td><?= $orders[0]['TENSP'] ?></td>
                    <td><?= $orders[0]['GIA'] ?></td>
                    <td><?= $orders[0]['SOLUONG'] ?></td>
                    <td><?= $orders[0]['TONGCONG'] ?></td>
                </tr>
            </tbody>
        </table>
        <br />
        <span class='makh'>Tổng tiền: <?= $orders[0]['THANHTIEN'] ?> </span>
    </div>
</body>
</html>