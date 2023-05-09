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

            <table class="table">

                <tr>
                    <th>نام سرویس دهنده</th>
                    <th>تعداد سفارشات</th>
                </tr>

                <?php foreach($reports as $report): ?>    
                <tr>
                    <td><?php echo $report["name"]; ?></td>
                    <td><?php echo $report["count"]; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</div>

</div>

</div>
</body>
</html>
