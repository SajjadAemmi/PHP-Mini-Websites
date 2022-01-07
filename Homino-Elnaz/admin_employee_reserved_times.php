<?php include('employee_panel.php'); ?>
<?php 

$employee_id = $_GET['employee_id'];

if(isset($_POST['reserve_cancel']))
{
    $reserve_id = $_POST['reserve_id'];
    $q = "DELETE FROM reserves WHERE id = $reserve_id";
    mysqli_query($con, $q);
}
if(isset($_POST['done']))
{
    $reserve_id = $_POST['reserve_id'];
    $q = "UPDATE reserves SET done = 1 WHERE id = $reserve_id";
    mysqli_query($con, $q);
}

$q = "SELECT reserves.id AS reserve_id , reserves.* ,  times.* , groups.*, employees.*, users.name AS user_name
        FROM reserves INNER JOIN times
        ON reserves.time_id = times.id
        INNER JOIN groups 
        ON times.group_id = groups.id
        INNER JOIN employees 
        ON times.employee_id = employees.id
        INNER JOIN users 
        ON reserves.user_id = users.id
        WHERE times.employee_id = $employee_id";

$reserves = mysqli_query($con, $q);

?>    

<div class="col-md-9">
    <div class="well">

        <table class="table table-striped table-bordered table-hover">

            <tr>
                <th>نام سفارش دهنده </th>
                <th>گروه کاری </th>
                <th>وضعیت رزرو </th>
                <th>تاریخ </th>
                <th>امتیاز داده شده </th>
            </tr>

            <?php foreach($reserves as $reserve): ?>    
            <tr>
                <td><?php echo $reserve["user_name"]; ?> </td>
                <td><?php echo $reserve["title"]; ?> </td>
                <td><?php if($reserve["done"] == 0) echo 'انجام نشده'; else echo 'انجام شده'; ?> </td>
                
                <td><?php echo $reserve["reserve_date"]; ?> </td>
                <td><?php echo $reserve["score"]; ?> </td>
            </tr>

            <?php endforeach; ?>
        </table>
    </div>
</div>

</div>

</div>
</body>
</html>
