<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">


</head>

<body>
    <div class="container">
        <div class="col-md-12">
            <h3>Thêm sản phẩm</h3>
            <form action='ajax_action.php' method="post" id="insert_data_kh">
                <label>Tên sản phẩm</label>
                <input type="text" class="form-control" id="tensp" placeholder="Tên sản phẩm" name='tensp'>
                <label>Mã loại</label>
                <input type="text" class="form-control" id="maloai" placeholder="Mã loại" name='maloai'>
                <label>Hình</label>
                <input type="file" class="form-control" id="hinh" name="image" onchange="onFileSelected(event)">
                <label>Mô tả</label>
                <input type="text" class="form-control" id="mota" placeholder="Mô tả">
                <label>Giá</label>
                <input type="text" class="form-control" id="gia" placeholder="Giá">
                <label>Số lượng</label>
                <input type="text" class="form-control" id="soluong" placeholder="Số lượng">
                <br>
                <input type="button" name="insert_data" id="button_insert" value="Insert" class="btn btn-success">
                <!-- <input type="button" value="Close" class="btn btn-danger" > -->
                <input type="button" value="Go back" onClick="javascript:history.go(-1)"  class="btn btn-danger"/>
            </form>
        </div>
    </div>
    <script src="./../jquery.js"></script>
    <script>
        var iurl;
        function onFileSelected(event) {
            var selectedFile = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function(event) {
                iurl = event.target.result;
                console.log(iurl);
            };

            reader.readAsDataURL(selectedFile);
        }
        $('#button_insert').on('click', function () {
            var tensp = $('#tensp').val();
            var maloai = $('#maloai').val();
            var hinh = iurl;
            var mota = $('#mota').val();
            var gia = $('#gia').val();
            var soluong = $('#soluong').val();
            if (tensp == '' || maloai == '' || mota == '' || gia == '' || soluong == '') {
                alert('Vui lòng nhập đầy đủ các trường')
            }
            else {
                $.ajax({
                    url: './../ajax_action.php',
                    method: 'POST',
                    data: {
                        tensp: tensp,
                        maloai: maloai,
                        hinh: hinh,
                        mota: mota,
                        gia: gia,
                        soluong: soluong
                    },
                    success: function (res) {
                        alert(res);
                        // $('#insert_data_kh')[0].reset();
                    }
                })
            }
        })

    </script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>

</html>