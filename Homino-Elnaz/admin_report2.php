<?php include('admin_panel.php'); ?>
<?php 

if(isset($_POST['submit']))
{
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    
    //die($end_date);

    $q = "SELECT COUNT(reserves.id) AS count, users.name
            FROM users left join reserves
            on users.id = reserves.user_id
            WHERE reserves.reserve_date >= '$start_date' AND reserves.reserve_date <= '$end_date'
            GROUP BY users.id";

}
else
{
    $q = "SELECT COUNT(reserves.id) AS count, users.name
        FROM users left join reserves
        on users.id = reserves.user_id
        GROUP BY users.id";
}

$reports = mysqli_query($con, $q);

?>    

<div class="col-md-9">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h5 class="text-center">
                گزارشات بر حسب کاربران            
            </h5>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <form class="form-inline" method="post" action="admin_report2.php">
                        <div class="form-group">
                            <label>از تاریخ</label>
                            <div class="input-group" dir="ltr">
                                <div class="input-group-addon" data-mddatetimepicker="true" data-trigger="click" data-targetselector="#fromDate1" data-groupid="group1"
                                     data-fromdate="true" data-enabletimepicker="false" data-placement="left">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </div>
                                <input name="start_date" type="text" class="form-control" id="fromDate1" placeholder="از تاریخ" data-mddatetimepicker="true" data-trigger="click"
                                       data-targetselector="#fromDate1" data-groupid="group1" data-fromdate="true" data-enabletimepicker="false" data-placement="bottom" autocomplete="off" data-englishnumber="true"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>تا تاریخ</label>
                            <div class="input-group" dir="ltr">
                                <div class="input-group-addon" data-mddatetimepicker="true" data-trigger="click" data-targetselector="#toDate1" data-groupid="group1"
                                     data-todate="true" data-enabletimepicker="true" data-placement="left">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </div>
                                <input name="end_date" type="text" class="form-control" id="toDate1" placeholder="تا تاریخ" data-mddatetimepicker="true" data-trigger="click"
                                       data-targetselector="#toDate1" data-groupid="group1" data-todate="true" data-enabletimepicker="false" data-placement="bottom" autocomplete="off" data-englishnumber="true"/>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-success">اعمال بازه تاریخی</button>
                    </form>
                </div>
            </div>
            <hr>
            <canvas id="myChart"></canvas>

        </div>
    </div>
</div>

<script>

    var colors = [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
    ];

    var colors2 = [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
    ];

    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: [
                <?php 
                foreach($reports as $report)
                {
                    echo '"' . $report['name'] . '",';
                }
                ?>
            ],
            datasets: [{
                label: "My First dataset",
                backgroundColor: colors,
                borderColor: colors2,
                data: [
                    <?php 
                    foreach($reports as $report)
                    {
                        echo '"' . $report['count'] . '",';
                    }
                    ?>
                ],
            }]
        },

        // Configuration options go here
        options: {
        scales: {
            yAxes: [{
                ticks: {
                    min: 0
                }
            }]
        }
    }
    });

</script>

</div>
</div>
<script src="js/jquery.Bootstrap-PersianDateTimePicker.js" type="text/javascript"></script>
</body>
</html>
