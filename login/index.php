<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
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
        $admin = 'admin';
        if(isset($_POST['submit'])){
            if(($_POST['name']=='admin' && $_POST['password']=='123456')){
                $_SESSION['current_user'] = $admin;
                header ('Location: ../index.php');
            }
        }?>
    
</body>
</html>