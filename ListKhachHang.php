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
        <a class="navbar-brand" href="#">Khách hàng</a>
        <ul class="nav navbar-nav">
            <li class="active">
                <a href="index.php">Home</a>
            </li>
            <li>
                <a href="ThemKhachHang.php">Thêm khách hàng</a>
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
        <label>Họ và tên</label>
                <input type="text" class="form-control" id="hovatenModal" placeholder="Điền vào họ tên" name='hovaten'>
                <label>Email</label>
                <input type="text" class="hidden" id="makh">
                <input type="text" class="form-control" id="emailModal" placeholder="Email">
                <label>Số điện thoại</label>
                <input type="text" class="form-control" id="phoneModal" placeholder="Số điện thoại">
                <label>Địa chỉ</label>
                <input type="text" class="form-control" id="diachiModal" placeholder="Địa chỉ">
        </div>
        <div class="modal-footer">
        <a href="#" id="save" class="btn btn-primary pull-right save">Save</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>

    </div>
    </div>

    <?php 
        include "connect.php";
        // include "XoaKhachHang.php";
        $selectKH = "select * from khachhang";
        $rs = $connect->query($selectKH);
        echo "<table class='table table-hover'>
        <thead>
            <tr>
                <th>Mã khách hàng</th>
                <th>Họ và tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>";
        if (mysqli_num_rows($rs)>0){
          while($row=mysqli_fetch_row($rs))
        {
          echo "<tr id='$row[0]'>
                    <td >$row[0]</td>
                    <td data-target='hovaten'>$row[1]</td>
                    <td data-target='email'>$row[2]</td>
                    <td data-target='sdt'>$row[3]</td>
                    <td data-target='diachi'>$row[4]</td>
                    <td>
                    <button class='btn btn-danger delete' iddelete='$row[0]'>Xóa</button>
                    <button class='btn btn-success update' data-toggle='modal' data-target='#myModal' idCapNhat='$row[0]'>Cập nhật</button>
                    </td>
                </tr>";
        }
        }
        echo "</tbody>
              </table>";
    ?>
    <script>
    //     $(".delete").click(function () {
    //     var maKH = $(this).attr("iddelete");
    //     $(this).parent().parent().remove();
    //     $.post("XoaKhachHang.php",
    //         {
    //             makhachhang: maKH
    //         },
    //         function (data, status) {

    //         });
    // });
    //xoa 
    $(document).on('click', '.delete', function(){
        var makh = $(this).attr('iddelete');
        $(this).parent().parent().remove();
        $.ajax({
            url: 'ajax_action.php',
            method: 'POST',
            data:{makh:makh},
            success: function(data){
                alert('Delete success');
            }
        })
    })
    //update
    $(document).on('click','.update', function(){
        var makh = $(this).attr('idCapNhat');
        var hovaten = $('#'+makh).children("td[data-target='hovaten']").text();
        var email = $('#'+makh).children("td[data-target='email']").text();
        var phone = $('#'+makh).children("td[data-target='sdt']").text();
        var diachi = $('#'+makh).children("td[data-target='diachi']").text();
        
        $(hovatenModal).val(hovaten);
        $(emailModal).val(email);
        $(phoneModal).val(phone);
        $(diachiModal).val(diachi);
        $(('#makh')).val(makh);
        // $.ajax({
        //     url: 'ajax_action.php',
        //     method: 'POST',
        //     data:{makh:makh}
        // })
    })

    $(document).on('click', '.save', function(){
        var hovatenUpdate = $('#hovatenModal').val();
        var emailUpdate = $('#emailModal').val();
        var phoneUpdate = $('#phoneModal').val();
        var diachiUpdate = $('#diachiModal').val();
        var makhUpdate = $('#makh').val();
        
        $.ajax({
            url: 'ajax_action.php',
            method: 'POST',
            data:{
                makhUpdate:makhUpdate,
                hovatenUpdate:hovatenUpdate,
                emailUpdate:emailUpdate,
                phoneUpdate:phoneUpdate,
                diachiUpdate:diachiUpdate
            },
            success:function(data){
                alert('Cập nhật thành công');
            }
        })
    })
    </script>
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>

</html>