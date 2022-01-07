<?php 
include 'database.php'; 
include 'functions.php'; 

if(isset($_POST['register_user']))
{
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = MD5($_POST['password']);
    $password2 = MD5($_POST['password2']);
    $age = $_POST['age'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];

    if($password == $password2)
    {
        $query = "SELECT * FROM users WHERE username = '$username'";

        $user = mysqli_query($connection, $query);

        if(mysqli_num_rows($user) > 0)
        {
            redirect('register.php', 'این نام کاربری قبلا انتخاب شده است', 'error');
        }
        else
        {
            if(isset($_FILES['avatar']))
            {
                move_uploaded_file($_FILES["avatar"]["tmp_name"] , "images/users/". $username .".jpg");
                $avatar = $username . ".jpg";
            }
            else
            {
                $avatar = 'noimage.jpg';
            }

            $query = "INSERT INTO users (name, username, password, email, age,gender, avatar) VALUES ('$name', '$username', '$password' ,'$email' ,'$age','$gender', '$avatar')";

            mysqli_query($connection, $query);

            redirect('index.php', 'ثبت نام شما با موفقیت انجام شد!', 'success'); 
        }	
    }
    else
    {
        redirect('register.php', 'در وارد نمودن کلمه عبور دقت فرمایید!', 'error');
    }
}
?>

<?php include 'header.php'; ?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h2 class="panel-title"> ثبت نام</h2>
            </div>
            <div class="panel-body">
                <form role="form" enctype="multipart/form-data" method="post" action="register.php">
                    <div class="form-group">
                        <label>نام و نام خانوادگی</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Your Name" required>
                    </div>

                    <div class="form-group">
                        <label> ایمیل </label>
                        <input type="email" name="email" class="form-control" placeholder="Enter Your Phone Number" required>
                    </div>


                    <div class="form-group">
                        <label> سن </label>
                        <input type="number" name="age" class="form-control" value="20" required min="10">
                    </div>


                    <label class="radio-title">
                        <input type="radio" value="1" name="gender" checked> <span> مرد </span>
                    </label>

                    <label class="radio-title">
                        <input type="radio" value="0" name="gender"> <span> زن </span>
                    </label>

                    <div class="form-group has-success has-feedback">
                        <label class="control-label">نام کاربری</label>
                        <div class="input-group"  dir="ltr">
                            <span class="input-group-addon">@</span>
                            <input type="text" name="username" class="form-control" placeholder="Enter Your Username" required>
                        </div>
                    </div>

                    <div class="form-group has-success has-feedback">
                        <label class="control-label">کلمه عبور</label>
                        <div class="input-group"  dir="ltr">
                            <span class="input-group-addon"> <span class="glyphicon glyphicon-lock" aria-hidden="true"></span> </span>
                            <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                        </div>
                    </div>
                    <div class="form-group has-success has-feedback">
                        <label class="control-label">تکرار کلمه عبور</label>
                        <div class="input-group"  dir="ltr">
                            <span class="input-group-addon"> <span class="glyphicon glyphicon-lock" aria-hidden="true"></span> </span>
                            <input type="password" name="password2" class="form-control" placeholder="Enter Password Again" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>بارگزاری تصویر</label>
                        <input type="file" name="avatar" class="btn btn-info">
                        <p class="help-block"></p>
                    </div>	  
                    <button type="submit" name="register_user" class="btn btn-success btn-lg btn-block">ثبت نام</button>
                </form>		
            </div>   
        </div>
    </div>
</div>

<?php include ('footer.php'); ?>