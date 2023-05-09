<?php include('header.php'); ?>
<?php

if(isset($_POST["user_register"]))
{
    $name               = $_POST["name"];
    $family             = $_POST["family"];
    $username           = $_POST["username"];
    $password           = md5($_POST["password"]);
    $confirm_password   = md5($_POST["confirm_password"]);
    $email              = $_POST["email"];
    $mobile             = $_POST["mobile"];
    $address            = $_POST["address"];

    if($password != $confirm_password)
    {
        $_SESSION["message"] = "در وارد نمودن کلمه عبور دفت نمایید";

        header("location: register.php");
    }
    else
    {
        $q = "SELECT * FROM users WHERE username = '$username'";
        $user_table = mysqli_query($con,$q);
        $num_of_rows = mysqli_num_rows($user_table);

        if($num_of_rows == 0) //good username
        {
            $q = "INSERT INTO users(name, family, username, password, email, mobile, address ) VALUES('$name','$family','$username','$password','$email','$mobile' ,'$address')";
            
            if(!mysqli_query($con, $q))
            {
                die(mysqli_error($con));
            }

            $_SESSION["message"] = "ثبت نام شما انجام شد. لطفا برای تایید شکیبا باشید.";

            header("location: index.php");
        }
        else //bad username
        {
            $_SESSION["message"] = "نام کاربری تکراری میباشد";

            header("location: register.php");
        } 
    }
}
elseif(isset($_POST["employee_register"]))
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

        header("location: register.php");
    }
    else
    {
        $q = "SELECT * FROM employees WHERE username = '$username'";
        $user_table = mysqli_query($con,$q);
        $num_of_rows = mysqli_num_rows($user_table);

        if($num_of_rows == 0) //good username
        {
            $q = "INSERT INTO employees(name, family, username, password, email, mobile, jensiat, rezume ) VALUES('$name','$family','$username','$password','$email','$mobile' ,'$jensiat ','$rezume')";
            
            if(!mysqli_query($con,$q))
            {
                die(mysqli_connect_error());
            }

            $_SESSION["message"] = "ثبت نام شما انجام شد. لطفا برای تایید شکیبا باشید.";

            header("location: index.php");
        }
        else //bad username
        {
            $_SESSION["message"] = "نام کاربری تکراری میباشد";

            header("location: register.php");
        } 
    }
}

?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
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
                    <form method="post" action="register.php">
                        <div class="form-group">
                            <label>نام</label>
                            <input type="text" name="name" class="form-control" placeholder="نام خود را وارد نمایید">
                        </div>
                        <div class="form-group">
                            <label>نام خانوادگی</label>
                            <input type="text" name="family" class="form-control" placeholder="نام خانوادگی خود را وارد نمایید">
                        </div>
                        <div class="form-group">
                            <label>نام کاربری</label>
                            <input type="text" name="username" class="form-control" placeholder="نام کاربری خود را وارد نمایید">
                        </div>
                        <div class="form-group">
                            <label>کلمه عبور</label>
                            <input type="password" name="password" class="form-control" placeholder="کلمه عبور را وارد نمایید">
                        </div>

                        <div class="form-group">
                            <label>تکرار کلمه عبور</label>
                            <input type="password" name="confirm_password" class="form-control" placeholder="تکرار کلمه عبور">
                        </div>
                        <div class="form-group">
                            <label>ایمیل</label>
                            <input type="email" name="email" class="form-control" placeholder="آدرس منزل">
                        </div>
                        <div class="form-group">
                            <label>ادرس منزل</label>
                            <input type="text" name="address" class="form-control" placeholder="آدرس منزل">
                        </div>
                        <div class="form-group">
                            <label> شماره همراه</label>
                            <input type="text" name="mobile" class="form-control" placeholder="شماره همراه">
                        </div>
                        <button type="submit" name="user_register" class="btn btn-success">ثبت نام</button>
                    </form>
                </div>
                <div role="tabpanel" class="tab-pane" id="employee">
                    <br>
                    <div class="alert alert-info fade in">
                        <p>توضیحی در مورد نحوه ارسال رزومه و ثبت نام</p>
                    </div>
                    <form method="post" action="register.php">
                        <div class="form-group">
                            <label>نام</label>
                            <input type="text" name="name" class="form-control" placeholder="نام خود را وارد نمایید">
                        </div>
                        <div class="form-group">
                            <label>نام خانوادگی</label>
                            <input type="text" name="family" class="form-control" placeholder="نام خانوادگی خود را وارد نمایید">
                        </div>
                        <div class="form-group">
                            <label>نام کاربری</label>
                            <input type="text" name="username" class="form-control" placeholder="نام کاربری خود را وارد نمایید">
                        </div>
                        <div class="form-group">
                            <label>کلمه عبور</label>
                            <input type="password" name="password" class="form-control" placeholder="کلمه عبور">
                        </div>
                        <div class="form-group">
                            <label>تکرار کلمه عبور</label>
                            <input type="password" name="confirm_password" class="form-control" placeholder=" تکرار کلمه عبور">
                        </div>
                        <div class="form-group">
                            <label>ایمیل</label>
                            <input type="email" name="email" class="form-control" placeholder="آدرس منزل">
                        </div>
                        <div class="form-group">
                            <label> شماره همراه</label>
                            <input type="text" name="mobile" class="form-control" placeholder="شماره همراه">
                        </div>
                        <label> جنسیت</label>
                        <div class="form-group">
                            <select class="form-control" name="jensiat">
                                <option value="man">مرد</option>
                                <option value="woman">زن</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label> ارسال رزومه</label>
                            <textarea type="text" name="rezume" class="form-control" placeholder="ارسال رزومه"></textarea>
                        </div>
                        <button type="submit" name="employee_register" class="btn btn-success">ثبت نام</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</body>
</html>