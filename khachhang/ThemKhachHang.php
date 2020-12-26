<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    
    <!-- Latest compiled and minified JS -->
    <script src="//code.jquery.com/jquery.js"></script>
    

</head>

<body>
    <div class="container">
        <div class="col-md-12">
            <h3>Thêm khách hàng</h3>
            <form action='ajax_action.php' method="post" id="insert_data_kh">
                <!-- <label>Mã khách hàng</label>
                <input type="text" class="form-control" id="makh" placeholder="Mã khách hàng"> -->
                <label>Họ và tên</label>
                <input type="text" class="form-control" id="hovaten" placeholder="Điền vào họ tên" name='hovaten'>
                <label>Email</label>
                <input type="text" class="form-control" id="email" placeholder="Email">
                <label>Số điện thoại</label>
                <input type="text" class="form-control" id="phone" placeholder="Số điện thoại">
                <label>Địa chỉ</label>
                <input type="text" class="form-control" id="diachi" placeholder="Địa chỉ">
                <br>
                <input type="button" name="insert_data" id="button_insert" value="Insert" class="btn btn-success">
                <!-- <input type="button" value="Close" class="btn btn-danger" > -->
                <input type="button" value="Go back" onClick="javascript:history.go(-1);"  class="btn btn-danger"/>
            </form>
        </div>
    </div>
    <script src="./../jquery.js"></script>
    <script>
        $('#button_insert').on('click', function () {
            // var makh = $('#makh').val();
            var hovaten = $('#hovaten').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var diachi = $('#diachi').val();

            if ( hovaten == '' || email == '' || phone == '' || diachi == '') {
                alert('Vui lòng nhập đầy đủ các trường')
            }
            else {
                $.ajax({
                    url: './../ajax_action.php',
                    method: 'POST',
                    data: {
                        // makh: makh,
                        hovaten: hovaten,
                        email: email,
                        phone: phone,
                        diachi: diachi
                    },
                    success: function (res) {
                        alert(res);
                        $('#insert_data_kh')[0].reset();
                    }
                })
            }
        })
    </script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>

</html>