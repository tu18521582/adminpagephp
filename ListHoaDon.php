<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="jquery.js"></script>
    
</head>

<body>
    <div class="navbar navbar-inverse">
        <a class="navbar-brand" href="#">Hóa đơn</a>
        <ul class="nav navbar-nav">
            <li class="active">
                <a href="index.php">Home</a>
            </li>
        </ul>
    </div>
    
    <!-- Trigger the modal with a button -->

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Sửa thông tin khách hàng</h4>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
        </div>
    </div>

    </div>
    </div>

    <?php 
        include "connect.php";
        // include "XoaKhachHang.php";
        $selectKH = "select * from hoadon";
        $rs = $connect->query($selectKH);
        echo "<table class='table table-hover'>
        <thead>
            <tr>
                <th>Mã hóa đơn</th>
                <th>Mã khách hàng</th>
                <th>Ngày hóa đơn</th>
                <th>Tổng số lượng</th>
                <th>Tổng cộng</th>
                <th>Giảm giá</th>
                <th>Thành tiền</th>
                <th>Ghi chú</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>";
        if (mysqli_num_rows($rs)>0){
          while($row=mysqli_fetch_row($rs))
        {
          echo "<tr id='$row[0]'>
                    <td >$row[0]</td>
                    <td data-target='makh'>$row[1]</td>
                    <td data-target='ngayhd'>$row[2]</td>
                    <td data-target='tongsl'>$row[3]</td>
                    <td data-target='tongcong'>$row[4]</td>
                    <td data-target='giamgia'>$row[5]</td>
                    <td data-target='thanhtien'>$row[6]</td>
                    <td data-target='ghichu'>$row[7]</td>
                    <td>
                    <button class='btn btn-success chitiet' data-toggle='modal' data-target='#myModal' chitietid='$row[0]'>Chi tiết</button>
                    </td>
                </tr>";
        }
        }
        echo "</tbody>
              </table>";
    ?>
    <script>
    //chi tiet hoa don
        $('.chitiet').click(function (){
            var mahd = $(this).attr('chitietid');
            $.ajax({
                url: 'ajax_action.php',
                method: 'POST',
                data:{mahd:mahd},
                success: function(data) {
                    $(".modal-body").html(data);
                }
            })
        })
    </script>
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>

</html>