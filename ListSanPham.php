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
    <style>
        i.fa {
            display: inline-block;
            border-radius: 60px;
            box-shadow: 0px 0px 2px #888;
            padding: 0.5em 0.6em;
        }
    </style>
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
        
        $.ajax({
            url: 'ajax_action.php',
            method: 'POST',
            data:{
                // makhUpdate:makhUpdate
                maspUpdate: maspupdate,
                tenspUpdate: tenspupdate,
                maloaiUpdate: maloaiupdate,
                motaUpdate: motaupdate,
                giaUpdate: giaupdate,
                soluongUpdate: soluongupdate,
                hinhanhUpdate: iurl
                
            },
            success:function(data){
                // alert('Cập nhật thành công');
                alert(data);
            }
        })
    })
    
    </script>
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>

</html>