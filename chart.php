<html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script src="./jquery.js"></script>

  </head>
  <body>
    <div id="chart_div"></div>
    
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
                    var options = {'title':'Biểu đồ sản phẩm đã duyệt và chưa duyệt',
                                'width':800,
                                'height':500};
                    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                    chart.draw(data, options);
                }
                });
            </script>
        "
    ?>
  </body>
</html>