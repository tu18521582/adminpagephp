<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
    
    <!-- Latest compiled and minified CSS -->
    
</head>
<body>
    <div class="form">
        <div class="avi"></div>
        <form action='' method='post'>
        <input type="text" value="Username" onfocus="this.value='';" name='name'/>
        <input type="text" value="Password" onfocus="this.value='';" name='password'/>
        <input type="submit" value="Login" action="submit" name='submit'/>
    </form>
    </div><!--form-->
    </div>
    <?php 
        include './../connect.php';
        session_start();
        if(isset($_POST['submit'])){
            $username = $_POST['name'];
            $password = $_POST['password'];
            $sql = "SELECT * FROM user WHERE TAIKHOAN='$username'";
            $rs = $connect->query($sql);
            $row=mysqli_fetch_row($rs);
            if(($username==$row[2] && $password==$row[3])){
                $_SESSION['current_admin'] = $row[0];
                $_SESSION['name_admin'] = $row[5];
                header ('Location: ../index.php');
            }
        }?>
    
</body>
</html>