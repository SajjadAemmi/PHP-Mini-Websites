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
                <h3 class="panel-title"> گزارش گیری - فیلم هایی که بیشترین بازدید را داشته اند </h3>
            </div>
            <div class="panel-body">
                <script src="js/Chart.min.js"></script>

                <div class="row">
                    <div class="col-md-12">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>

    var Ajax_data = null;

    var labels = [];
    var data = [];
    var backgroundColor = [];
    var borderColor = [];

    var colors = [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
    ];

    var colors2 = [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
    ];

    var b = ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"];

    xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            Ajax_data = JSON.parse(this.responseText);

            var n = Object.keys(Ajax_data).length;

            for (i = 0; i < n; i++)
            {
                labels[i] = Ajax_data[i].name; 
                data[i] = parseInt(Ajax_data[i].score_sum); 
                
                backgroundColor[i] = colors[i%6];
                borderColor[i] = colors2[i%6];
            }

            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: '# of Votes',
                        data: data,
                        backgroundColor: backgroundColor,
                        borderColor: borderColor,
                        borderWidth: 5
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        }
    };
    xmlhttp.open("GET","get_reports2.php",true);
    xmlhttp.send();


</script>

<?php include 'footer.php'; ?> 