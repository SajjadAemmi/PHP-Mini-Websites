<?php include('employee_panel.php'); ?>
<?php 

$employee_id = $_SESSION['employee_id'];

if(isset($_POST["add_time"]))
{
    $start_time               = $_POST["start_time"];
    $end_time           = $_POST["end_time"];
    $date           = $_POST["date"];
    $group_id   = $_POST["group"];

    $q = "INSERT INTO times(employee_id, start_time,end_time,date,group_id) values('$employee_id','$start_time','$end_time','$date','$group_id')";
    mysqli_query($con,$q);

    $_SESSION["message"] = "زمان اضافه شد";
    header("location: employee_add_time.php");
}

$q = "SELECT * FROM groups";
$groups  = mysqli_query($con, $q);

?>    

<div class="col-md-9">
    <div class="well">
        <form method="post" action="employee_add_time.php">
            <div class="form-group">

                <label>ساعت شروع</label>
                <input type="time" name="start_time" class="form-control" placeholder="نام خود را وارد نمایید">
            </div>
            <div class="form-group">
                <label>ساعت پایان</label>
                <input type="time" name="end_time" class="form-control" placeholder="نام کاربری خود را وارد نمایید">
            </div>

            <div class="form-group">
                <label>تاریخ</label>
                <div class="input-group" dir="ltr">
                    <div class="input-group-addon" data-mddatetimepicker="true" data-trigger="click" data-targetselector="#exampleInput3">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </div>
                    <input type="text" name="date" class="form-control" id="exampleInput3" data-targetselector="#exampleInput3" data-mddatetimepicker="true"
                           data-placement="bottom" data-englishnumber="true" autocomplete="off" />
                </div>
            </div>


            <label for="exampleInputPassword1">  گروه کاری</label>
            <div class="form-group">
                <select class="form-control" name="group">
                    <?php foreach($groups as $group): ?>
                    <option value="<?php echo $group["id"]; ?>"> <?php echo $group["title"]; ?> </option>
                    <?php endforeach; ?>
                </select>

            </div>
            <button type="submit" name="add_time" class="btn btn-success">ثبت زمان</button>
        </form>

    </div>
</div>

</div>

</div>


<script src="js/jquery.Bootstrap-PersianDateTimePicker.js" type="text/javascript"></script>

</body>
</html>
