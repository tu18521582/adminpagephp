<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <!-- <form action=''method="post">
        <label>Tài khoản</label>
        </br>
        <input type='text' name='name'>
        </br>
        <input type='password' name='password'> 
        </br>
        </br>
        <input type='submit' name='submit'>
    </form>  -->

<!-- 
    <div class="form">
    <div class="avi"></div>
  <form action='' method='post'>
    <input type="text" value="Username" onfocus="this.value='';" name='name'/>
    <input type="password" value="Password" onfocus="this.value='';" name='password'/>
    <input type="submit" value="Login" name='submit'/>
  </form>
</div>form
<div class="recovery">Forgot your password? <a href="#">Click here</a></div> -->



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
        include '../connect.php';
        if(isset($_POST['submit'])){
            if($_POST['name']=='admin' && $_POST['password']=='123456'){
                header ('Location: ../index.php');
            }
            else {
                echo "Bạn nhập sai tài khoản hoặc mật khẩu";
            }
        }?>
    
</body>
</html>