
<?php
    include "connect.php";
		$count_prd = mysqli_num_rows(mysqli_query($con, "SELECT * FROM sanpham"));
        $count_user = mysqli_num_rows(mysqli_query($con, "SELECT * FROM user WHERE ROLE=1"));
		$count_cus = mysqli_num_rows(mysqli_query($con, "SELECT * FROM khachhang"));
?>
<div class="col-lg-12">				
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Trang chủ quản trị</h1>
			</div>
        </div><!--/.row-->
        <div class="col-sm-1"></div>
        <div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-orange panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $count_user?></div>
							<div class="text-muted">Nhân viên</div>
						</div>
					</div>
				</div>
            </div>
		
		<div class="row">
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $count_prd ?></div>
							<div class="text-muted">Sản Phẩm</div>
						</div>
					</div>
				</div>
			</div>
	
            <div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $count_cus ?></div>
							<div class="text-muted">Khách hàng</div>
						</div>
					</div>
				</div>
			</div>
			
        </div><!--/.row-->
        <div class="row"> 
            <div class="col-sm-2"></div>
        <div id="chart_div" class="col-xs-12 col-md-6 col-lg-3"></div>
    <?php
        include "connect.php";
        $countChuaDuyet = (int)mysqli_fetch_row($connect->query("SELECT count(*) from hoadon where TrangThai = 0"))[0];
        $countDaDuyet = (int)mysqli_fetch_row($connect->query("SELECT count(*) from hoadon where TrangThai = 1"))[0];
        echo "
            <script>
            $(document).ready(function () {
                google.load('visualization', '1.0', {'packages':['corechart']});
                google.setOnLoadCallback(drawChart);
                function drawChart() {
                    var data = new google.visualization.DataTable();
                    data.addColumn('string', 'Topping');
                    data.addColumn('number', 'Slices');
                    data.addRows([
                    ['Chưa duyệt', $countChuaDuyet],
                    ['Đã duyệt', $countDaDuyet],
                    ]);
                    var options = {'title':'Biểu đồ hóa đơn đã duyệt và chưa duyệt',
                                'width':600	,
                                'height':350};
                    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                    chart.draw(data, options);
                }
                });
            </script>
        "
    ?>
        </div>
	</div>	<!--/.main-->