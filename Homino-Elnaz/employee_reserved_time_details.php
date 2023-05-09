<?php include('employee_panel.php'); ?>
<?php 

$employee_id = $_SESSION['employee_id'];
$reserve_id = $_GET['reserve_id'];

if(isset($_POST['reserve_cancel']))
{
    $reserve_id = $_POST['reserve_id'];
    $q = "DELETE FROM reserves WHERE id = $reserve_id";
    mysqli_query($con, $q);
}

$q = "SELECT reserves.id AS reserve_id , reserves.* ,  times.* , groups.*, employees.*, users.name AS user_name, users.mobile AS user_mobile, users.address AS user_address
        FROM reserves INNER JOIN times
        ON reserves.time_id = times.id
        INNER JOIN groups 
        ON times.group_id = groups.id
        INNER JOIN employees 
        ON times.employee_id = employees.id
        INNER JOIN users 
        ON reserves.user_id = users.id
        WHERE times.employee_id = $employee_id AND reserves.id = $reserve_id";

$reserve = mysqli_fetch_assoc(mysqli_query($con, $q));

?>    

<div class="col-md-9">
    <div class="well">

        <table class="table">

            <tr>
                <th>ساعت شروع کار</th>
                <th>ساعت پایان کار</th>
                <th>تاریخ کار </th>
                <th>تاریخ رزرو </th>
                <th>گروه کاری </th>
                <th>وضعیت رزرو </th>
                <th> </th> 
            </tr>

            <tr>
                <td><?php echo $reserve["start_time"]; ?></td>
                <td><?php echo $reserve["end_time"]; ?></td>
                <td><?php echo $reserve["date"]; ?> </td>
                <td><?php echo $reserve["reserve_date"]; ?> </td>
                <td><?php echo $reserve["title"]; ?> </td>
                <td><?php if($reserve["done"] == 0) echo 'انجام نشده'; else echo 'انجام شده'; ?> </td>
            </tr>
        </table>
        
        <hr>
        
                <table class="table">

            <tr>
                <th>نام سفارش دهنده </th>
                <th>شماره تماس </th>
                <th>آدرس </th>
                 
            </tr>

            <tr>
                <td><?php echo $reserve["user_name"]; ?> </td>
                <td><?php echo $reserve["user_mobile"]; ?> </td>
                <td><?php echo $reserve["user_address"]; ?> </td>
                
            </tr>
        </table>

    </div>
</div>

</div>

</div>
</body>
</html>
