<!DOCTYPE html>
<html lang="en">

<head>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
   
   <!-- Latest compiled and minified CSS -->
   <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

   <!--
      <link href="css/bootstrap-table.css" rel="stylesheet">

   -->
   <script src="js/lumino.glyphs.js"></script>
   <link href="css/styles.css" rel="stylesheet">

   <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script src="./jquery.js"></script>
   
   <!-- Latest compiled and minified JS -->
   <script src="//code.jquery.com/jquery.js"></script>
   
   <style>
        .nav-pills > li > a {
            border-radius: 0;
         }

#wrapper {
   padding-left: 0;
   -webkit-transition: all 0.5s ease;
   -moz-transition: all 0.5s ease;
   -o-transition: all 0.5s ease;
   transition: all 0.5s ease;
   overflow: hidden;
}

#wrapper.toggled {
   padding-left: 300px;
   overflow: hidden;
}

#sidebar-wrapper {
   z-index: 1000;
   position: absolute;
   left: 300px;
   width: 0;
   height: 100%;
   margin-left: -300px;
   overflow-y: auto;
   background: #000;
   -webkit-transition: all 0.5s ease;
   -moz-transition: all 0.5s ease;
   -o-transition: all 0.5s ease;
   transition: all 0.5s ease;
}

#wrapper.toggled #sidebar-wrapper {
   width: 300px;
}

#page-content-wrapper {
   position: absolute;
   padding: 15px;
   width: 100%;
   overflow-x: hidden;
}

.xyz {
   min-width: 360px;
}

#wrapper.toggled #page-content-wrapper {
   position: relative;
   margin-right: 0px;
}

.fixed-brand {
   width: auto;
}
/* Sidebar Styles */

.sidebar-nav {
   position: absolute;
   top: 0;
   width: 300px;
   margin: 0;
   padding: 0;
   list-style: none;
   margin-top: 2px;
}

.sidebar-nav li {
   text-indent: 15px;
   line-height: 40px;
}

.sidebar-nav li a {
   display: block;
   text-decoration: none;
   color: #999999;
}

.sidebar-nav li a:hover {
   text-decoration: none;
   color: #fff;
   background: rgba(255, 255, 255, 0.2);
   border-left: red 2px solid;
}

.sidebar-nav li a:active,
.sidebar-nav li a:focus {
   text-decoration: none;
}

.sidebar-nav > .sidebar-brand {
   height: 65px;
   font-size: 18px;
   line-height: 60px;
}

.sidebar-nav > .sidebar-brand a {
   color: #999999;
}

.sidebar-nav > .sidebar-brand a:hover {
   color: #fff;
   background: none;
}

.no-margin {
   margin: 0;
}

@media (min-width: 768px) {
   #wrapper {
      padding-left: 300px;
   }
   .fixed-brand {
      width: 300px;
   }
   #wrapper.toggled {
      padding-left: 0;
   }
   #sidebar-wrapper {
      width: 300px;
   }
   #wrapper.toggled #sidebar-wrapper {
      width: 300px;
   }
   #wrapper.toggled-2 #sidebar-wrapper {
      width: 50px;
   }
   #wrapper.toggled-2 #sidebar-wrapper:hover {
      width: 300px;
   }
   #page-content-wrapper {
      padding: 20px;
      position: relative;
      -webkit-transition: all 0.5s ease;
      -moz-transition: all 0.5s ease;
      -o-transition: all 0.5s ease;
      transition: all 0.5s ease;
   }
   #wrapper.toggled #page-content-wrapper {
      position: relative;
      margin-right: 0;
      padding-left: 300px;
   }
   #wrapper.toggled-2 #page-content-wrapper {
      position: relative;
      margin-right: 0;
      margin-left: -200px;
      -webkit-transition: all 0.5s ease;
      -moz-transition: all 0.5s ease;
      -o-transition: all 0.5s ease;
      transition: all 0.5s ease;
      width: auto;
   }
}
   img {
      width: 1102px;
      margin-left: -38px;
      margin-top: -20px;
      height: 625px;
   }

   .mr-5 {
      margin-right: 5px;
   }
   </style>
   <script src='jquery.js'></script>
</head>

<body>
   <?php 
      include "connect.php";
      session_start();
      if (!isset($_SESSION['current_admin'])){
         echo "<div class='mr-5'>Bạn chưa đăng nhập, vui lòng đăng nhập</div>";
         echo "<a href='login/index.php' class='btn btn-primary'>Đăng nhập</a>";
         exit;
      }
      $userid = (int)$_SESSION['current_admin'];
      $sql = "SELECT HOTEN FROM user where USERID = $userid";
      $rs = $connect->query($sql);
      $nameCurrentLogIn=mysqli_fetch_row($rs);
   ?>
   <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#"><span>GrimmDC </span>Shop</a>
                  <ul class="user-menu">
							<li class="dropdown pull-right">
								<ul class="dropdown-menu" role="menu">
									<li><a href="#"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Hồ sơ</a></li>
									<li><a href="logout.php"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Đăng xuất</a></li>
								</ul>
							</li>
						</ul>
					</div>
									
				</div><!-- /.container-fluid -->
			</nav>
   <nav class="navbar navbar-default no-margin">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header fixed-brand nav-flex">
         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" id="menu-toggle">
         <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
         </button>
         <a class="navbar-brand" href="#" style="color: black;"><i class="fa fa-rocket fa-4 mr-5" ></i>Hello admin,<span>
            <?php 
               echo $nameCurrentLogIn[0];
            ?>
         </span></a>
      </div>
      <!-- navbar-header-->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
         <ul class="nav navbar-nav">
            <li class="active">
               <button class="navbar-toggle collapse in" data-toggle="collapse" id="menu-toggle-2"> <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
               </button>
            </li>
         </ul>
      </div>
      <!-- bs-example-navbar-collapse-1 -->
   </nav>
   <div id="wrapper">
      <!-- Sidebar -->
      <div id="sidebar-wrapper">
         <ul class="sidebar-nav nav-pills nav-stacked" id="menu">
            <li class="active">
               <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-dashboard fa-stack-1x "></i></span>Dashboard</a>
            </li>
            <li>
               <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-users fa-stack-1x "></i></span>Khách hàng</a>
               <ul class="nav-pills nav-stacked" style="list-style-type:none;">
                  <li><a href="khachhang/ListKhachHang.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-users fa-stack-1x "></i></span>Danh sách khách hàng</a></li>
                  <li><a href="khachhang/ThemKhachHang.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-plus fa-stack-1x "></i></span>Thêm khách hàng</a></li>
               </ul>
            </li>
            <li>
               <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-product-hunt fa-stack-1x "></i></span>Sản phẩm</a>
               <ul class="nav-pills nav-stacked" style="list-style-type:none;">
                  <li><a href="sanpham/ListSanPham.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-product-hunt fa-stack-1x "></i></span>Danh sách sản phẩm</a></li>
                  <li><a href="sanpham/ThemSanPham.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-plus fa-stack-1x "></i></span>Thêm sản phẩm</a></li>
               </ul>
            </li>
            <li>
               <a href="hoadon/ListHoaDon.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-credit-card-alt fa-stack-1x "></i></span>Hóa đơn</a>
            </li>
            <li>
               <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa fa-user fa-stack-1x "></i></span>Quản lý tài khoản</a>
               <ul class="nav-pills nav-stacked" style="list-style-type:none;">
                  <li><a href="taikhoan/ListTaiKhoanAdmin.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-user fa-stack-1x "></i></span>Tài khoản admin</a></li>
                  <li><a href="taikhoan/ListTaiKhoanKH.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-user fa-stack-1x "></i></span>Tài khoản khách hàng</a></li>
               </ul>
            </li>
            <li>
               <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa fa-bar-chart fa-stack-1x "></i></span>Thống kê</a>
               <ul class="nav-pills nav-stacked" style="list-style-type:none;">
                  <li><a href="thongke/TopSPBanChay.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-bars fa-stack-1x "></i></span>Top 5 bán chạy</a></li>
                  <li><a href="./chart.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-plus fa-stack-1x "></i></span>Biểu đồ duyệt hàng</a></li>
               </ul>
            </li>
            <li>
            <!-- login/index.php -->
               <a href="login/index.php" class='logout'><span class="fa-stack fa-lg pull-left"><i class="fa fa-sign-out fa-stack-1x "></i></span>Đăng xuất</a>
            </li>
         </ul>
      </div>
      <!-- /#sidebar-wrapper -->
      <!-- Page Content -->
      <div id="page-content-wrapper">
         <!--
            <div class="container-fluid xyz">
            <div class="row">
               <div class="col-lg-12">
                     <img src="https://image.freepik.com/free-vector/shopping-cart-online-shop-laptop-sale_115739-900.jpg?fbclid=IwAR2I9kLqxMnnq7Ce4S1p3uWB7uTvj8cIZAjxqBELzNRJiNvVoIGdjN6xXLY">
               </div>
            </div>
         </div>
         -->
         <?php
            include "sub_index.php";
         ?>
    
      </div>
      <!-- /#page-content-wrapper -->
   </div>
   <!-- /#wrapper -->
   <!-- jQuery -->

    <script>
         $('.logout').click(function (e) { 
            console.log('ok');
            var logout = 'logout';
            $.ajax({
                    url: 'ajax_action.php',
                    method: 'POST',
                    data:{logout: logout},
                    success: function(data) {
                        console.log(data);
                    }
                })
         });

        $("#menu-toggle").click(function(e) {
               e.preventDefault();
               $("#wrapper").toggleClass("toggled");
            });
         $("#menu-toggle-2").click(function(e) {
               e.preventDefault();
               $("#wrapper").toggleClass("toggled-2");
               $('#menu ul').hide();
            });

         function initMenu() {
            $('#menu ul').hide();
            $('#menu ul').children('.current').parent().show();
            //$('#menu ul:first').show();
            $('#menu li a').click(
               function() {
                  var checkElement = $(this).next();
                  if ((checkElement.is('ul')) && (checkElement.is(':visible'))) {
                     return false;
                  }
                  if ((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
                     $('#menu ul:visible').slideUp('normal');
                     checkElement.slideDown('normal');
                     return false;
                  }
               }
            );
         }
$(document).ready(function() {
   initMenu();
});
    </script>
</body>

</html>