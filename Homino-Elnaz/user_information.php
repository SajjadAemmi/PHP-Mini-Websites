<?php include('user_panel.php'); ?>
<?php 

$user_id = $_SESSION['user_id'];

if(isset($_POST["user_edit"]))
{
    $name               = $_POST["name"];
    $family             = $_POST["family"];
    $username           = $_POST["username"];
    $password           = $_POST["password"];
    $confirm_password   = $_POST["confirm_password"];
    $email              = $_POST["email"];
    $mobile             = $_POST["mobile"];
    $address            = $_POST["address"];

    if($password != $confirm_password)
    {
        $_SESSION["message"] = "در وارد نمودن کلمه عبور دفت نمایید";
    }
    else
    {
        $q = "SELECT * FROM users WHERE username = '$username' AND id <> $user_id";
        $user_table= mysqli_query($con,$q);
        $num_of_rows=mysqli_num_rows($user_table);

        if( $num_of_rows==0) //good username
        {
            $q = "UPDATE users
                    SET name = '$name',
                    family = '$family',
                    username = '$username', 
                    password = '$password', 
                    email = '$email', 
                    mobile = '$mobile', 
                    address = '$address'
                    WHERE id = $user_id";

            mysqli_query($con,$q);
        }
        else //bad username
        {
            $_SESSION["message"] = "نام کاربری تکراری میباشد";
        } 
    }
}

$q = "SELECT * FROM users WHERE id = $user_id";
$user_table  = mysqli_query($con, $q);
$user = mysqli_fetch_assoc($user_table);

?>    

<div class="col-md-9">
    <div class="well">
        <form method="post" action="user_information.php">
            <div class="form-group">
                <label>نام</label>
                <input type="text" name="name" value="<?php echo $user['name']; ?>" class="form-control" placeholder="نام">
            </div>
            <div class="form-group">
                <label>نام خانوادگی</label>
                <input type="text" name="family" value="<?php echo $user['family']; ?>" class="form-control" placeholder="نام خانوادگی">
            </div>
            <div class="form-group">
                <label>نام کاربری</label>
                <input type="text" name="username" value="<?php echo $user["username"]; ?>" class="form-control" placeholder="نام کاربری">
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
                <input type="email" name="email" value="<?php echo $user["email"];?>" class="form-control" placeholder="ایمیل">
            </div>
            <div class="form-group">
                <label>ادرس منزل</label>
                <input type="text" name="address" value="<?php echo $user["address"];?>" class="form-control" placeholder="آدرس منزل">
            </div>
            <div class="form-group">
                <label> شماره همراه</label>
                <input type="text" name="mobile" value="<?php echo $user["mobile"];?>" class="form-control" placeholder="شماره همراه">
            </div>
            <button type="submit" name="user_edit" class="btn btn-success">ثبت تغییرات</button>
        </form>
    </div>
</div>

</div>
</div>
</body>
</html>
