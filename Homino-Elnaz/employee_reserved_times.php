<?php include('employee_panel.php'); ?>
<?php 

$employee_id = $_SESSION['employee_id'];

if(isset($_POST['reserve_cancel']))
{
    $reserve_id = $_POST['reserve_id'];
    $q = "DELETE FROM reserves WHERE id = $reserve_id";
    mysqli_query($con, $q);
}
if(isset($_POST['reserve_accept']))
{
    $reserve_id = $_POST['reserve_id'];
    $q = "UPDATE reserves SET accept = 1 WHERE id = $reserve_id";
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
            </tr>

            <?php foreach($reserves as $reserve): ?>    
            <tr>
                <td><?php echo $reserve["user_name"]; ?> </td>
                <td><?php echo $reserve["title"]; ?> </td>
                <td><?php if($reserve["done"] == 0) echo 'انجام نشده'; else echo 'انجام شده'; ?> </td>
                <td><a href="employee_reserved_time_details.php?reserve_id=<?php echo $reserve["reserve_id"]; ?>" class="btn btn-info btn-block">مشاهده جزییات</a></td>
                <?php if($reserve["done"] == 0): ?>
                <form method="post" action="employee_reserved_times.php">
                    <input type="hidden" name="reserve_id" value="<?php echo $reserve["reserve_id"]; ?>">
                    <?php if($reserve["accept"] == 0): ?>
                    <td>
                        <button type="submit" name="reserve_cancel" class="btn btn-danger btn-block">لغو رزرو</button> 
                    </td>
                    <td>
                        <button type="submit" name="reserve_accept" class="btn btn-success btn-block">پذیرش</button> 
                    </td>
                    <?php else: ?>
                    <td>
                        <button type="submit" name="done" class="btn btn-primary btn-block">اتمام کار</button> 
                    </td>
                    <?php endif; ?>
                </form>
            </tr>

            <?php endif; ?>

            <?php endforeach; ?>
        </table>
    </div>
</div>

</div>

</div>
</body>
</html>
