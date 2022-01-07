<?php include('header.php'); ?>
<?php

if(isset($_POST["user_login"]))
{
    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $remember = $_POST['remember'];

    $q = "SELECT * FROM users WHERE username = '$username' AND password = '$password' AND valid = 1";
    $user_table = mysqli_query($con,$q);

    if(mysqli_num_rows($user_table) == 0) //failed login
    {
        $q = "SELECT * FROM users WHERE username = '$username' AND password = '$password' AND valid = 0";
        $user_table = mysqli_query($con,$q);

        if(mysqli_num_rows($user_table) == 0) //failed login
        {
            $_SESSION['message'] = "در وارد کردن اطلاعات دقت نمایید";
        }
        else
        {
            $_SESSION['message'] = "ثبت نام شما تایید نشده است. لطفا بعدا مراجعه بفرمایید.";
        }
        header("location: login.php");
    }
    else //success login
    {
        $user = mysqli_fetch_assoc($user_table);
        
        if($remember == true)
        {
            $cookie_name = "user_id";
            $cookie_value = $user['id'];
            //expiriry time. 86400 = 1 day (86400*30 = 1 month)
            $expiry = time() + (86400 * 30);
            //setting cookie variable
            setcookie($cookie_name, $cookie_value, $expiry);
        }
        
        $_SESSION['login'] = 1;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['family'] = $user['family'];

        $_SESSION['message'] = "شما وارد حساب کاربری خود شدید";

        header("location: user_panel.php");
    }
}
elseif(isset($_POST["employee_login"]))
{
    $username = $_POST["username"];
    $password = md5($_POST["password"]);

    $q = "SELECT * FROM employees WHERE username = '$username' AND password = '$password' AND valid = 1";
    $employees_table = mysqli_query($con,$q);

    if(mysqli_num_rows($employees_table) == 0) //failed login
    {
        $q = "SELECT * FROM employees WHERE username = '$username' AND password = '$password' AND valid = 0";
        $employees_table = mysqli_query($con,$q);

        if(mysqli_num_rows($employees_table) == 0) //failed login
        {
            $_SESSION['message'] = "در وارد کردن اطلاعات دقت نمایید";
        }
        else
        {
            $_SESSION['message'] = "ثبت نام شما تایید نشده است. لطفا بعدا مراجعه بفرمایید.";
        }
        header("location: login.php");
    }
    else //success login
    {
        $employee = mysqli_fetch_assoc($employees_table);

        $_SESSION['login'] = 1;
        $_SESSION['employee_id'] = $employee['id'];
        $_SESSION['name'] = $employee['name'];
        $_SESSION['family'] = $employee['family'];

        $_SESSION['message'] = "شما وارد حساب کاربری خود شدید";

        header("location: employee_information.php");
    }
}
elseif(isset($_POST['user_forget_password']))
{
    $_SESSION['username'] = $_POST["username"];
    $_SESSION['reset_password'] = true;
    header("location: user_send_mail.php");
}
elseif(isset($_POST['employee_forget_password']))
{
    $_SESSION['username'] = $_POST["username"];
    $_SESSION['reset_password'] = true;
    header("location: employee_send_mail.php");
}

?>

<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="well">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#user" aria-controls="home" role="tab" data-toggle="tab">کاربر</a></li>
                <li role="presentation"><a href="#employee" aria-controls="profile" role="tab" data-toggle="tab">سرویس دهنده</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="user">
                    <br>
                    <form method="post" action="login.php">
                        <div class="form-group">
                            <label>نام کاربری</label>
                            <input type="text" name="username" class="form-control" placeholder="نام کاربری خود را وارد نمایید" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">کلمه عبور</label>
                            <input type="password" name="password" class="form-control" placeholder="کلمه عبور را وارد نمایید">
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="remember">
                            <label>مرا به خاطر بسپار</label>
                        </div>

                        <button type="submit" name="user_login" class="btn btn-success">ورود</button>
                        <button type="submit" name="user_forget_password" class="btn btn-link">فراموش کردن کلمه عبور</button>
                    </form>
                </div>
                <div role="tabpanel" class="tab-pane" id="employee">
                    <br>
                    <form method="post" action="login.php">
                        <div class="form-group">
                            <label>نام کاربری</label>
                            <input type="text" name="username" class="form-control" placeholder="نام کاربری خود را وارد نمایید">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">کلمه عبور</label>
                            <input type="password" name="password" class="form-control" placeholder="کلمه عبور">
                        </div>

                        <button type="submit" name="employee_login" class="btn btn-success">ورود</button> 
                        <button type="submit" name="employee_forget_password" class="btn btn-link">فراموش کردن کلمه عبور</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>