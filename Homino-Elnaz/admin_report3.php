<?php include('admin_panel.php'); ?>
<?php 

$q = "SELECT COUNT(id) AS count, date(reserve_date) AS date
        FROM  reserves
        GROUP BY date(reserve_date)";

$reports = mysqli_query($con, $q);

?>    

<div class="col-md-9">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h5 class="text-center">
                گزارشات بر حسب تاریخ            
            </h5>
        </div>
        <div class="panel-body">

            <table class="table">

                <tr>
                    <th>تاریخ</th>
                    <th>تعداد سفارشات</th>
                </tr>

                <?php foreach($reports as $report): ?>    
                <tr>
                    <td><?php echo $report["date"]; ?></td>
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
