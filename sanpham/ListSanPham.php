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
        .fa-tshirt {
            font-size: 35px;
            margin-top: 12px;
            color: #3079b4;
        }

        i.fa-tshirt {
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
                <span><i class='fas fa-tshirt'></i></span>
                    <div class='header-detail'>
                        <span class='bold'>Products</span>   
                        <span>$row[0] sản phẩm</span>
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

<?php 
        // define how many results you want per page
        $results_per_page = 10;

        // find out the number of results stored in database
        $sql='SELECT * FROM sanpham';
        $result = mysqli_query($con, $sql);
        $number_of_results = mysqli_num_rows($result);

        // determine number of total pages available
        $number_of_pages = ceil($number_of_results/$results_per_page);

        // determine which page number visitor is currently on
        if (!isset($_GET['page'])) {
        $page = 1;
        } else {
        $page = $_GET['page'];
        }

        // determine the sql LIMIT starting number for the results on the displaying page
        $this_page_first_result = ($page-1)*$results_per_page;

        // retrieve selected results from database and display them on page
        $sql='SELECT * FROM sanpham LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
        $rs = $connect->query($sql);

        if ($rs === false) {
            echo 'lay du lieu that bai';
        }
?>
    
<div class="navbar navbar-default">
        <a class="navbar-brand">Sản phẩm</a>
        <ul class="nav navbar-nav">
            <li>
                <a id="home"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
            </li>
            <li>
                <a href="ThemSanPham.php"><i class="fa fa-plus" aria-hidden="true"></i>Thêm sản phẩm</a>
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
                <label>Tên sản phẩm</label>
                <input type="text" class="form-control" id="tenspmodal" placeholder="Điền vào tên sản phẩm">
                <label>Mã loại</label>
                <input type="text" class="hidden" id="maspupdate">
                <input type="text" class="form-control" id="maloaimodal" placeholder="Mã loại">
                <label>Mô tả</label>
                <input type="text" class="form-control" id="motamodal" placeholder="Mô tả">
                <label>Giá</label>
                <input type="text" class="form-control" id="giamodal" placeholder="Giá">
                <label>Số lượng</label>
                <input type="text" class="form-control" id="soluongmodal" placeholder="Số lượng">
                <label>Hình ảnh</label>
                <img id='imgmodal' src='' style="width:50px">
                <input type="file" class="form-control" id="hinhanhmodal" onchange="onFileSelected(event)">
        </div>
        <div class="modal-footer">
            <a href="#" id="save" class="btn btn-primary pull-right save">Save</a>
            <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
        </div>
    </div>

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
                    <td data-target='tensp'>$row[1]</td>
                    <td data-target='maloai'>$row[2]</td>
                    <td data-target='mota'>$row[8]</td>
                    <td data-target='gia'>$row[9]</td>
                    <td data-target='soluong'>$row[10]</td>
                    <td><img class='img-des' src='$row[3]'></td>
                    <td>
                    <button class='btn btn-danger delete' iddelete='$row[0]' style='margin-bottom: 7px'>Xóa</button>
                    <button class='btn btn-success update' data-toggle='modal' data-target='#myModal' idupdate='$row[0]'>Cập nhật</button>
                    </td>
                </tr>";
        }
        }
        echo "</tbody>
              </table>";
        // display the links to the pages
        echo "<div class='pagination'>";
        for ($page=1;$page<=$number_of_pages;$page++) {
            echo '<a href="ListSanPham.php?page=' . $page . '">' . $page . '</a> ';
        }
        echo "</div>"
    ?>
    <script>
        $(document).ready(function () {
            $(document).on('click', '#home',function(){
                window.location = "http://localhost:90/adminpage/#";
            })
    //xoa san pham
        $(document).on('click', '.delete', function(){
            var masp = $(this).attr('iddelete');
            $(this).parent().parent().remove();
            $.ajax({
                url: './../ajax_action.php',
                method: 'POST',
                data:{masp:masp},
                success: function(data){
                    // alert('Delete success');
                    alert('Xóa thành công');
                }
            })
        })

        //update
        var maspupdate;
        var tenspupdate;
        var maloaiupdate;
        var motaupdate;
        var giaupdate;
        var soluongupdate;
        var hinhanhupdate;
    $(document).on('click','.update', function(){
        maspupdate = $(this).attr('idupdate');
        tenspupdate = $('#'+maspupdate).children("td[data-target='tensp']").text();
        maloaiupdate = $('#'+maspupdate).children("td[data-target='maloai']").text();
        motaupdate = $('#'+maspupdate).children("td[data-target='mota']").text();
        giaupdate = $('#'+maspupdate).children("td[data-target='gia']").text();
        soluongupdate = $('#'+maspupdate).children("td[data-target='soluong']").text();
        hinhanhupdate = $('.img-des').attr("src");

        $(tenspmodal).val(tenspupdate);
        $(maloaimodal).val(maloaiupdate);
        $(motamodal).val(motaupdate);
        $(giamodal).val(giaupdate);
        $(soluongmodal).val(soluongupdate);
        // $('#imgmodal').attr('src', hinhanhupdate);
        $(('#maspupdate')).val(maspupdate);
    })


    var iurl;
    function onFileSelected(event) {
        var selectedFile = event.target.files[0];
        var reader = new FileReader();

        reader.onload = function(event) {
            iurl = event.target.result;
        };

        reader.readAsDataURL(selectedFile);
    }
    $(document).on('click', '.save', function(){

        if (!iurl) {
            iurl = 'null';
        }
        
        tenspupdate1 = $(tenspmodal).val();
        maspupdate1 = maspupdate;
        maloaiupdate1 = $(maloaimodal).val();
        motaupdate1 = $(motamodal).val();
        giaupdate1 = $(giamodal).val();
        soluongupdate1 = $(soluongmodal).val();

        $.ajax({
            url: './../ajax_action.php',
            method: 'POST',
            data:{
                // makhUpdate:makhUpdate
                maspUpdate: maspupdate1,
                tenspUpdate: tenspupdate1,
                maloaiUpdate: maloaiupdate1,
                motaUpdate: motaupdate1,
                giaUpdate: giaupdate1,
                soluongUpdate: soluongupdate1,
                hinhanhUpdate: iurl
                
            },
            success:function(data){
                alert('Cập nhật thành công');
                console.log(data);
                // window.location.reload();

            }
        })
    })
        });
    
    </script>
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>

</html>