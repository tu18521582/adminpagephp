<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="./../jquery.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <style>
        /* .hidden {
            display: none;
        } */
        .fa-user-circle {
            font-size: 35px;
            margin-top: 12px;
            color: #3079b4;
        }

        i.fa-user-circle   {
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

        #inputSearch {
            height: 34px;
        }

        #home {
            cursor: pointer;
        }

        .mr-5 {
            margin-right: 5px;
        }
    </style>
</head>

<body>
<?php 
        include "connect.php";
        $selectCount = "select count(*) from user where role=0;";
        $rs = $connect->query($selectCount);
        $row=mysqli_fetch_row($rs);
        echo "
        <div class='header-customer'>
            <div class='flex'>
                <span><i class='fas fa-user-circle'></i></span>
                    <div class='header-detail'>
                        <span class='bold'>Accounts</span>   
                        <span>$row[0] tài khoản</span>
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
?>
    <div class="navbar navbar-default">
        <a class="navbar-brand" href="#">Tài khoản</a>
        <ul class="nav navbar-nav">
            <li>
                <a href="#" id="home">Home</a>
            </li>
        </ul>
    </div>

    <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Chi tiết tài khoản</h4>
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
        session_start();
        $idAdmin = $_SESSION['current_admin'];
        echo "<div id='temp' idAdmin='$idAdmin'><div>";
        include "connect.php";
        $selectKH = "select * from user where role=0";
        $rs = $connect->query($selectKH);
        echo "<table class='table table-hover'>
        <thead>
            <tr>
                <th>Mã tài khoản</th>
                <th>Mã khách hàng</th>
                <th>Tài khoản</th>
                <th>Role</th>
                <th>Họ tên</th>
                <th>Hành động</th>
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
                    <td data-target='tongcong'>$row[4]</td>
                    <td data-target='tongcong'>$row[5]</td>
                    <td>
                        <button class='btn btn-success chitiet' data-toggle='modal' data-target='#myModal' chitietid='$row[0]'><i class='fas fa-info-circle mr-5'></i>Chi tiết</button>
                        <button class='btn btn-danger delete' iddelete='$row[0]''>Xóa <i class='fa fa-trash' aria-hidden='true'></i></button>
                    </td>
                </tr>";
        }
        }
        echo "</tbody>
              </table>";
    ?>
    <script>
        $(document).ready(function () {
            $(document).on('click', '#home',function(){
                window.location = "http://localhost:90/adminpage/#";
            })
            //chi tiet tai khoan
            $('.chitiet').click(function (){
                var userid = $(this).attr('chitietid');
                $.ajax({
                    url: './../ajax_action.php',
                    method: 'POST',
                    data:{userid:userid},
                    success: function(data) {
                        $(".modal-body").html(data);
                    }
                })
            })

            $('.delete').click(function (e) { 
                var deleteID = $(this).attr('iddelete');
                $.ajax({
                    url: './../ajax_action.php',
                    method: 'POST',
                    data:{deleteID:deleteID},
                    success: function(data) {
                        alert('Xóa tài khoản thành công !');
                        window.location.reload();
                    }
                })
            });


        });
    </script>
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>

</html>