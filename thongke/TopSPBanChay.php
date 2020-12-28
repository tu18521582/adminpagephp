<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="img.css">
    <script src="./../jquery.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    
    <style>
        #home:hover {
            cursor: pointer;
        }

        .bold {
            font-weight: bold;
            font-size: 24px;
            margin-top: 14px
        }

        .fa-plus {
            font-size: 35px;
            margin-top: 12px;
            color: #3079b4;
        }

        i.fa-plus {
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

        .pagination {
            display: inline-block;
            }

            .pagination a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            }

            .pagination a.active {
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
            }

            .pagination a:hover:not(.active) {
            background-color: #ddd;
            border-radius: 5px;
            }
        img {
            width: 60px;
        }
    </style>
</head>

<body>

<?php 
        include "connect.php";
        $selectCount = "select count(*) from sanpham;";
        $rs = $connect->query($selectCount);
        $row=mysqli_fetch_row($rs);
        echo "
        <div class='header-customer'>
            <div class='flex'>
                <span><i class='fas fa-plus''></i></span>
                    <div class='header-detail'>
                        <span class='bold'>Statistic</span>   
                    </div>
            </div>
        </div>
        ";
?>

<?php   


        // find out the number of results stored in database
        $sql='SELECT MASP, SUM(SOLUONG) as SLBan from cthd GROUP by MASP ORDER BY SUM(SOLUONG) DESC LIMIT 5';
        $rs = $connect->query($sql);
?>
    
<div class="navbar navbar-default">
        <a class="navbar-brand">Top 5 sản phẩm bán chạy</a>
        <ul class="nav navbar-nav">
            <li>
                <a id="home" href='http://localhost:90/adminpage/#'><i class="fa fa-home" aria-hidden="true"></i>Home</a>
            </li>
        </ul>
    </div>
    
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->

    </div>
    </div>

    <?php 
        include "connect.php";
        // include "XoaKhachHang.php";
        echo "<table class='table table-hover'>
        <thead>
            <tr>
                <th>Mã sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng bán</th>
            </tr>
        </thead>
        <tbody>";
        $arrMaSP = [];
        if (mysqli_num_rows($rs)>0){
          while($row=mysqli_fetch_row($rs))
        {
            $arrMaSP[] = $row[0];
            $sql="SELECT TENSP, HINHCHINH FROM SANPHAM WHERE MASP='$row[0]'";
            $result=$connect->query($sql);
            $rowSP = mysqli_fetch_row($result);
            echo "<tr>
                    <td>$row[0]</td>
                    <td>$rowSP[0]</td>
                    <td><img src='$rowSP[1]'></td>
                    <td>$row[1]</td>
                </tr>";
        }
        }
        echo "</tbody>
              </table>";
        // display the links to the pages
        echo "<div class='pagination'>";
        echo "</div>"
    ?>

    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>

</html>