<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    
    <script src="jquery.js"></script>
    <style>
        .fa-users {
            font-size: 35px;
            margin-top: 12px;
            color: #3079b4;
        }

        i.fa-users {
            display: inline-block;
            border-radius: 60px;
            box-shadow: 0px 0px 2px #888;
            padding: 0.5em 0.6em;
            background-color: white;
        }

        .header-customer {
            width: 100%;
            height: 100px;
            background-color: #03bbad;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .flex {
            display: flex;
            margin-left: 30px;
        }

        .header-detail {
            margin-left: 20px;
            display: flex;
            flex-direction: column;
            margin-top: 15px;
        }

        .bold {
            font-weight: bold;
            font-size: 24px;
        }

        .refresh {
            margin-right: 30px;
            background-color: transparent;
        }

        li:hover {
            background-color: #afbcc7;
        }

        li a i{
            margin-right: 6px;
        }

        .search {
            text-align: right;
            margin-right: 30px;
            margin-bottom: 10px;
            margin-top: -10px;
        }
    </style>
</head>

<body>
    
    <?php 
        include "connect.php";
        $selectCount = "select count(*) from khachhang;";
        $rs = $connect->query($selectCount);
        $row=mysqli_fetch_row($rs);
        echo "
        <div class='header-customer'>
            <div class='flex'>
                <span><i class='fa fa-users' aria-hidden='true'></i></span>
                    <div class='header-detail'>
                        <span class='bold'>Customers</span>   
                        <span>$row[0] khách hàng</span>
                    </div>
            </div>
            <div class='refresh'>
                <button onClick='window.location.reload();' style='color: black'>
                    <span class='glyphicon glyphicon-refresh'></span>
                    Refresh
                </button>
            </div>
        </div>
        ";
        $selectKH = "select * from khachhang";
        $rs = $connect->query($selectKH);
    ?>
    
    <div class="navbar navbar-default">
        <a class="navbar-brand">Khách hàng</a>
        <ul class="nav navbar-nav">
            <li>
                <a href="index.php"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
            </li>
            <li>
                <a href="ThemKhachHang.php"><i class="fa fa-plus" aria-hidden="true"></i>Thêm khách hàng</a>
            </li>
        </ul>
    </div>

    <div class='search'>
        <span><i class="fa fa-search" aria-hidden="true"></i>Tìm kiếm</span>
        <input placeholder="Tìm kiếm tên" name='search'>
        <button type="button" id='btnSearch'>Search</button>
        
    </div>

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
        echo "<table class='table table-bordered'>
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
                    <button class='btn btn-danger delete' iddelete='$row[0]' onClick='window.location.reload();'>Xóa <i class='fa fa-trash' aria-hidden='true'></i></button>
                    <button class='btn btn-success update' data-toggle='modal' data-target='#myModal' idCapNhat='$row[0]'>Cập nhật <span class='glyphicon glyphicon-edit'></span></button>
                    </td>
                </tr>";
        }
        }
        echo "</tbody>
              </table>";
    ?>
    <script>
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

    $(document).on('click', '#btnSearch', function(){
        alert('hello');
    })
    </script>
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>

</html>