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
        .fa-file-invoice {
            font-size: 35px;
            margin-top: 12px;
            color: #3079b4;
        }

        i.fa-file-invoice   {
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
        $selectCount = "select count(*) from hoadon;";
        $rs = $connect->query($selectCount);
        $row=mysqli_fetch_row($rs);
        echo "
        <div class='header-customer'>
            <div class='flex'>
                <span><i class='fas fa-file-invoice'></i></span>
                    <div class='header-detail'>
                        <span class='bold'>Invoices</span>   
                        <span>$row[0] hóa đơn</span>
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
        <a class="navbar-brand" href="#">Hóa đơn</a>
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
        <h4 class="modal-title">Chi tiết hóa đơn</h4>
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
        $total = "select sum(thanhtien) from hoadon where trangthai =1";
        $doanhthu = $connect->query($total);
        $dt = mysqli_fetch_row($doanhthu);
        $selectKH = "select * from hoadon";
        $rs = $connect->query($selectKH);
        echo "<table class='table table-hover'>
        <thead>
            <tr>
                <th>Mã hóa đơn</th>
                <th>Mã khách hàng</th>
                <th>Ngày hóa đơn</th>
                <th>Thành tiền</th>
                <th>Ghi chú</th>
                <th>Trạng thái</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>";
        if (mysqli_num_rows($rs)>0){
          while($row=mysqli_fetch_row($rs))
        {
                $status = ($row[8]==1 ? 'Đã duyệt' : 'Chưa duyệt');
            echo "<tr id='$row[0]'>
                    <td >$row[0]</td>
                    <td data-target='makh'>$row[1]</td>
                    <td data-target='ngayhd'>$row[2]</td>
                    <td data-target='tongcong'>$row[4]</td>
                    <td data-target='giamgia'>$row[5]</td>
                    <td data-target='ghichu'>$row[7]</td>
                    <td data-target='trangthai'>$status</td>
                    <td>";
            if ($row[6] == 1) echo "<button class='btn btn-danger mr-5' disabled>Đã duyệt</button>";
            else echo "<button class='btn btn-info mr-5 duyet' duyetid='$row[0]'>Duyệt</button>";
            echo        "<button class='btn btn-success chitiet' data-toggle='modal' data-target='#myModal' chitietid='$row[0]'><i class='fas fa-info-circle mr-5'></i>Chi tiết</button>
                        <a href='InHoaDon.php?id=$row[0]' target='_blank' class='btn btn-primary'><i class='fas fa-print mr-5'></i>In</a>
                    </td>
                </tr>";
        }
        }
        echo "
             <h1 style='text-align: right;'>Doanh thu: $dt[0]  VND</h1>";
        echo "</tbody>
              </table>";
    ?>
    <script>
        $(document).ready(function () {
            $(document).on('click', '#home',function(){
                window.location = "http://localhost:90/adminpage/#";
            })
    //chi tiet hoa don
            $('.chitiet').click(function (){
                var mahd = $(this).attr('chitietid');
                $.ajax({
                    url: './../ajax_action.php',
                    method: 'POST',
                    data:{mahd:mahd},
                    success: function(data) {
                        console.log(data);
                        $(".modal-body").html(data);
                    }
                })
            })

            $('.duyet').click(function (){
                var duyetid = $(this).attr('duyetid');
                var idNguoiDuyet = $('#temp').attr('idAdmin');
                $.ajax({
                    url: './../ajax_action.php',
                    method: 'POST',
                    data: {
                        duyetid: duyetid,
                        idnguoiduyet: idNguoiDuyet
                    },
                    success: function(data) {
                        window.location.reload();
                    }
                })
            })
        });
    </script>
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>

</html>