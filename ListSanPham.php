<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="img.css">
    <script src="jquery.js"></script>
    
</head>

<body>
    <div class="navbar navbar-inverse">
        <a class="navbar-brand" href="#">Sản phẩm</a>
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
        <h4 class="modal-title">Sửa thông tin sản phẩm</h4>
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
        $selectKH = "select * from sanpham";
        $rs = $connect->query($selectKH);
        echo "<table class='table table-hover'>
        <thead>
            <tr>
                <th>Mã sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Mã loại</th>
                <th>Mô tả</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Hình ảnh</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>";
        if (mysqli_num_rows($rs)>0){
          while($row=mysqli_fetch_row($rs))
        {
          echo "<tr id='$row[0]'>
                    <td >$row[0]</td>
                    <td >$row[1]</td>
                    <td >$row[2]</td>
                    <td >$row[8]</td>
                    <td >$row[9]</td>
                    <td >$row[10]</td>
                    <td><img class='img-des' src='$row[3]'></td>
                    <td>
                    <button class='btn btn-danger delete' iddelete='$row[0]' style='margin-bottom: 7px'>Xóa</button>
                    <button class='btn btn-success chitiet' data-toggle='modal' data-target='#myModal'>Cập nhật</button>
                    </td>
                </tr>";
        }
        }
        echo "</tbody>
              </table>";
    ?>
    <script>
    //xoa san pham
        $(document).on('click', '.delete', function(){
            var masp = $(this).attr('iddelete');
            $(this).parent().parent().remove();
            $.ajax({
                url: 'ajax_action.php',
                method: 'POST',
                data:{masp:masp},
                success: function(data){
                    // alert('Delete success');
                    alert('Xóa thành công');
                }
            })
        })
    </script>
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>

</html>