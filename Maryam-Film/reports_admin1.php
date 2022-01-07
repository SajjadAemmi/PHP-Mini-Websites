<?php 
include 'database.php';
include 'functions.php';
include 'header.php';
?>    

<div class="row">
    <div class="col-md-12">
        <a href="panel_admin.php" class="btn btn-danger">
            بازگشت به پنل ادمین <i class="fa fa-arrow-left"></i>
        </a>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title"> گزارش گیری - تعداد فیلم های تماشا شده توسط هر کاربر </h3>
            </div>
            <div class="panel-body">

                <script type="text/javascript" src="js/loader.js"></script>
                <script type="text/javascript">

                    var Ajax_data = null;
                    var Chart_data = [['نام کاربر', 'امتیاز']];

                    xmlhttp = new XMLHttpRequest();

                    xmlhttp.onreadystatechange = function() 
                    {
                        if (this.readyState == 4 && this.status == 200) 
                        {
                            Ajax_data = JSON.parse(this.responseText);

                            for (i = 0; i < Object.keys(Ajax_data).length; i++)
                            {
                                Chart_data.push([Ajax_data[i].name, Ajax_data[i].score_count]); 
                            }
                        }
                    };
                    xmlhttp.open("GET","get_reports1.php",true);
                    xmlhttp.send();

                    google.charts.load('current', {'packages':['bar']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable(Chart_data);

                        var options = {
                            chart: {
                                
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('chart'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>

                <div class="row">
                    <div class="col-md-12">
                        <p id="demo"></p>
                        <div id="chart" dir="ltr" style="width: 100%; height: 500px;"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?> 