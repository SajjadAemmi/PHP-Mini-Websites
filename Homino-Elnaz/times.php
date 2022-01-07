<?php include('header.php'); ?>
<?php 

if(isset($_POST["reserve"]))
{
    $time_id = $_POST["time_id"];
    $user_id = $_SESSION["user_id"];
    
    $timestamp = jdate('Y/m/d H:i:s','','','','en');
    
    $q = "INSERT INTO reserves(user_id, time_id, reserve_date) VALUES('$user_id', '$time_id', '$timestamp')";
    mysqli_query($con, $q);

    $_SESSION['message'] = "درخواست شما با موفقیت رزرو شد. با شما تماس گرفته خواهد شد!";

    header("location: user_reserved_times.php");
}

if(isset($_POST['filter']))
{
    $group_id = $_POST['group'];

    $q = "SELECT times.*, employees.name, groups.title
            FROM times INNER JOIN employees
            ON times.employee_id = employees.id
            INNER JOIN groups 
            ON times.group_id = groups.id
            WHERE times.group_id = $group_id";
}
else
{
    $q = "SELECT times.*, employees.name, groups.title
            FROM times INNER JOIN employees
            ON times.employee_id = employees.id
            INNER JOIN groups 
            ON times.group_id = groups.id";
}

$times = mysqli_query($con, $q);

$q = "SELECT * FROM groups";
$groups  = mysqli_query($con, $q);

?>    

<div class="col-md-8 col-md-offset-2">
    <div class="well">
        <form class="form-inline" method="post" action="times.php">
            <div class="form-group">
                <select class="form-control" name="group">
                    <?php foreach($groups as $group): ?>
                    <option value="<?php echo $group["id"]; ?>" <?php if(isset($group_id) && $group["id"] == $group_id) echo 'selected'; ?>> <?php echo $group["title"]; ?> </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <input type="submit" class="btn btn-primary" value="اعمال فیلتر" name="filter">
        </form>
        <br>
        <?php if(mysqli_num_rows($times) > 0): ?>
        <table class="table table-striped table-bordered table-hover">

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
                <?php if(isset($_SESSION['login'])): ?>
                <td> 
                    <form method="post" action="times.php">
                        <input name="time_id" type="hidden" value="<?php echo $time["id"]; ?>">
                        <button name="reserve" type="submit" class="btn btn-success btn-block">رزرو</button> 
                    </form>
                </td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php else: ?>
        <p>از دسته بندی انتخاب شده، زمان خالی موجود نمی باشد</p>
        <?php endif; ?>
    </div>
</div>

</div>
</div>
</body>
</html>