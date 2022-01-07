<?php include('admin_panel.php'); ?>
<?php 

$q = "SELECT COUNT(reserves.id) AS count, groups.title 
        FROM groups left join times 
        on groups.id = times.group_id
        left join reserves
        on times.id = reserves.time_id
        GROUP BY title";

$reports = mysqli_query($con, $q);

?>    

<div class="col-md-9">
    <div class="well">
      
        <table class="table">

            <tr>
                <th>عنوان دسته بندی</th>
                <th>تعداد سفارشات</th>
            </tr>

            <?php foreach($reports as $report): ?>    
            <tr>
                <td><?php echo $report["title"]; ?></td>
                <td><?php echo $report["count"]; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>

    </div>
</div>

</div>

</div>
</body>
</html>
