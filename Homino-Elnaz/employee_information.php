<?php include('employee_panel.php'); ?>
<?php 

$employee_id = $_SESSION['employee_id'];

if(isset($_POST["employee_edit"]))
{
    $name               = $_POST["name"];
    $family             = $_POST["family"];
    $username           = $_POST["username"];
    $password           = md5($_POST["password"]);
    $confirm_password   = md5($_POST["confirm_password"]);
    $email              = $_POST["email"];
    $mobile             = $_POST["mobile"];
    $jensiat            = $_POST["jensiat"];
    $rezume             = $_POST["rezume"];

    if($password != $confirm_password)
    {
        $_SESSION["message"] = "در وارد نمودن کلمه عبور دفت نمایید";
    }
    else
    {
        $q = "SELECT * FROM employees WHERE username = '$username' AND id <> $employee_id";
        $employee_table= mysqli_query($con,$q);
        $num_of_rows=mysqli_num_rows($employee_table);

        if($num_of_rows == 0) //good username
        {
            $q = "UPDATE employees
                    SET name = '$name', 
                    family = '$family',
                    username = '$username', 
                    password = '$password', 
                    email = '$email',
                    mobile = '$mobile', 
                    jensiat = '$jensiat',
                    rezume  = '$rezume'
                    WHERE id = $employee_id";

            if(!mysqli_query($con, $q))
            {
                die(mysqli_error($con));
            }
            $_SESSION["message"] = "اطلاعات ویرایش شد";
        }
        else //bad username
        {
            $_SESSION["message"] = "نام کاربری تکراری میباشد";
        } 
    }
    header("location: employee_information.php");
}

$q = "SELECT * FROM employees WHERE id = $employee_id";
$employee  = mysqli_fetch_assoc(mysqli_query($con, $q));

?>    

<div class="col-md-9">
    <div class="well">
        <form method="post" action="employee_information.php">
            <div class="form-group">
                <label>نام</label>
                <input type="text" name="name"value="<?php echo $employee['name']; ?>" class="form-control" placeholder="نام">
            </div>
            <div class="form-group">
                <label>نام خانوادگی</label>
                <input type="text" name="family" value="<?php echo $employee['family']; ?>" class="form-control" placeholder="نام خانوادگی">
            </div>
            <div class="form-group">
                <label>نام کاربری</label>
                <input type="text" name="username"value="<?php echo $employee['username']; ?>" class="form-control" placeholder="نام کاربری">
            </div>
            <div class="form-group">
                <label>کلمه عبور</label>
                <input type="password" name="password" class="form-control" placeholder="کلمه عبور">
            </div>

            <div class="form-group">
                <label>تکرار کلمه عبور</label>
                <input type="password" name="confirm_password" class="form-control" placeholder="تکرار کلمه عبور">
            </div>
            <div class="form-group">
                <label>ایمیل</label>
                <input type="email" name="email" value="<?php echo $employee["email"];?>" class="form-control" placeholder="ایمیل">
            </div>
            <div class="form-group">
                <label> شماره همراه</label>
                <input type="text" name="mobile" value="<?php echo $employee["mobile"]; ?>" class="form-control" placeholder="شماره همراه">
            </div>
            <label>  جنسیت</label>
            <div class="form-group">
                <select class="form-control" name="jensiat">
                    <option value="man">مرد</option>
                    <option value="woman">زن</option>
                </select>
            </div>
            <div class="form-group">
                <label> ارسال رزومه</label>
                <textarea type="text" name="rezume" class="form-control" placeholder="ارسال رزومه"><?php echo $employee["rezume"]; ?></textarea>
            </div>
            <button type="submit" name="employee_edit" class="btn btn-success">ثبت ویرایش</button>
        </form>
    </div>
</div>

</div>
</div>
</body>
</html>
