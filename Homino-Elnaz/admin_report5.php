<?php include('admin_panel.php'); ?>
<?php 

$q = "SELECT COUNT(reserves.id) AS count , employees.name
FROM employees left join times
on employees.id = times.employee_id
left join reserves
on times.id = reserves.time_id
group by employees.id";

$reports = mysqli_query($con, $q);

?>    

<div class="col-md-9">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h5 class="text-center">
                گزارش سفارشات بر حسب سرویس دهنده           
            </h5>
        </div>
        <div class="panel-body">

           <canvas id="myChart"></canvas>

        </div>
    </div>
</div>

<script>

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
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
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
        options: {}
    });

</script>

</div>

</div>
</body>
</html>
