<?php include('admin_panel.php'); ?>
<?php 

$q = "SELECT * 
        FROM times INNER JOIN employees
        ON times.employee_id = employees.id
        INNER JOIN groups 
        ON times.group_id = groups.id";

$times = mysqli_query($con, $q);

?>    

<div class="col-md-9">
    <div class="well">
      
        <table class="table">

            <tr>
                <th>ساعت شروع</th>
                <th>ساعت پایان</th>
                <th>تاریخ </th>
                <th>نام سرویس دهنده </th>
                <th>گروه کاری </th>
                <th> </th> 
            </tr>

            <?php foreach($times as $time): ?>    
            <tr>
                <td><?php echo $time["start_time"]; ?></td>
                <td><?php echo $time["end_time"]; ?></td>
                <td><?php echo $time["date"]; ?> </td>
                <td><?php echo $time["name"]; ?> </td>
                <td><?php echo $time["title"]; ?> </td>
            </tr>
            <?php endforeach; ?>
        </table>

    </div>
</div>

</div>

</div>
</body>
</html>
